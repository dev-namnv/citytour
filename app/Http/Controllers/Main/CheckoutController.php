<?php

namespace App\Http\Controllers\Main;

use App\Helpers\VNPayHelper;
use App\Models\CancelPolicy;
use App\Models\PaymentLog;
use App\Models\TourLog;
use App\Scopes\GuideBehaviorScope;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout\PaymentRequest;
use App\Models\Batch;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Tour;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function detail($slug)
    {
        $tour = Tour::query()->withGlobalScope('GuideBehaviorScope', new GuideBehaviorScope)->with('albums','reviews','category','schedules')
            ->with(['batches'=>function($q){
                $q->where('batch','>',now())->select();
            }])
            ->where('slug',$slug)
            ->firstOrFail();
        $invoices = Invoice::query()->where('tour_id',$tour->id)
            ->where('start_date',$tour->batches->first()->batch)
            ->get(['adult_count','child_count']);
        $customer_total = $invoices->sum('adult_count') + $invoices->sum('child_count');
        $cancel_policies = CancelPolicy::all();

        return view('Main.checkout.detail', compact('tour', 'customer_total', 'cancel_policies'));
    }

    public function payment(PaymentRequest $request)
    {
//        try {
            $tour = Tour::query()->find($request->tour_id);
            $batch = Batch::query()->where('batch', $request->batch)->first();

            if ($tour && $batch) {
                $adult_cost = $tour->getRawOriginal('adult_price') * $request->adult_count;
                $child_cost = $tour->getRawOriginal('child_price') * $request->child_count;
                $total_cost = $adult_cost + $child_cost;
                $deposit_cost = $total_cost * 30/100; // Phí đặt cọc 30%
                $payment_code = strtoupper(uniqid());

                /**
                 * VNPay
                 */
                session(['cost_id' => $payment_code]);
                session(['url_prev' => url()->previous()]);
                $vnp_TmnCode = env('VNP_TMNCODE'); //Mã website tại VNPAY
                $vnp_HashSecret = env('VNP_HASHSECRET'); //Chuỗi bí mật
                $vnp_Url = env('VNP_URL');
                $vnp_Returnurl = route('checkout.confirmation');
                $vnp_TxnRef = $payment_code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
                $vnp_OrderInfo = "Thanh toán hóa đơn đặt cọc Tour " . $tour->name;
                $vnp_OrderType = 'billpayment';
                $vnp_Amount = $deposit_cost * 100;
                $vnp_Locale = 'vn';
                $vnp_IpAddr = request()->ip();

                $inputData = array(
                    "vnp_Version" => "2.0.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,
                );

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . $key . "=" . $value;
                    } else {
                        $hashdata .= $key . "=" . $value;
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                    $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                    $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
                }

                /**
                 * Kiểm tra tài khoản tồn tại tạo tài khoản định danh
                 */
                $user = User::query()->where('email', $request->customer_email)->first();
                if (Auth::check()) {
                    $new_user_log = new UserLog([
                        'title' => $vnp_OrderInfo,
                        'points' => $total_cost/100,
                        'user_id' => Auth::id()
                    ]);
                } else {
                    if ($user) {
                        $new_user_log = new UserLog([
                            'title' => $vnp_OrderInfo,
                            'points' => $total_cost/100,
                            'user_id' => $user->id
                        ]);
                    } else {
                        $user = new User([
                            'first_name' => $request->customer_name,
                            'last_name' => '',
                            'email' => $request->customer_email,
                            'phone' => $request->customer_phone,
                            'address' => $request->customer_address,
                            'city' => $request->city,
                            'zipcode' => $request->zipcode,
                            'country' => $request->country,
                            'password' => Hash::make($request->customer_email),
                            'state' => $request->state
                        ]);
                        $new_user->save();

                        $new_user_log = new UserLog([
                            'title' => $vnp_OrderInfo,
                            'point' => $total_cost/100,
                            'user_id' => $new_user->id
                        ]);
                    }
                }

                /**
                 * Tạo hóa đơn
                 */
                $new_invoice = new Invoice([
                    'sku' => $payment_code,
                    'start_date' => $batch->batch,
                    'adult_count' => $request->adult_count,
                    'child_count' => $request->child_count,
                    'sub_cost' => $total_cost,
                    'vat_cost' => 0,
                    'total_cost' => $total_cost,
                    'payment_type' => 'VNPay',
                    'payment_code' => $payment_code,
                    'payment_status' => PAYMENT_STATUS_FAIL,
                    'deposit_cost' => $deposit_cost,
                    'customer_name' => $request->customer_name,
                    'customer_address' => $request->customer_address,
                    'customer_email' => $request->customer_email,
                    'customer_phone' => $request->customer_phone,
                    'customer_message' => $request->customer_message ?? '',
                    'status' => INVOICE_NEW,
                    'tour_id' => $tour->id,
                    'guide_id' => $tour->guide_id,
                    'user_id' => Auth::check() ? Auth::id() : $user->id
                ]);
                $new_invoice->save();

                /**
                 * Hóa đơn chi tiết
                 */
                $invoice_detail = new InvoiceDetail([
                    'invoice_id' => $new_invoice->id,
                    'name' => $tour->name,
                    'address' => $tour->address,
                    'thumbnail' => $tour->thumbnail,
                    'adult_price' => $tour->getRawOriginal('adult_price'),
                    'child_price' => $tour->getRawOriginal('child_price'),
                    'schedule' => json_decode($tour->schedules, true)
                ]);
                $invoice_detail->save();

                $new_user_log->save();

                /**
                 * Thêm tour log
                 */
                $new_tour_log = new TourLog([
                    'tour_id' => $tour->id,
                    'user_id' => Auth::check() ? Auth::id() : ($user ? $user->id : $new_user->id)
                ]);
                $new_tour_log->save();
            }

            /**
             * Payment log
             */
            $new_payment_log = new PaymentLog([
                'batch' => $request->batch,
                'adult_count' => $request->adult_count,
                'child_count' => $request->child_count,
                'deposit_cost' => $deposit_cost,
                'total_cost' => $total_cost,
                'payment_type' => PAYMENT_TYPE_VNPAY,
                'payment_code' => $payment_code,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'tour_id' => $tour->id,
                'guide_id' => $tour->guide_id,
                'user_id' => Auth::check() ? Auth::id() : ($user ? $user->id : $new_user->id)
            ]);
            $new_payment_log->save();
            session()->put(PAYMENT_CODE, $payment_code);
            return redirect($vnp_Url);
        /*} catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }*/
    }

    public function confirmation(Request $request)
    {
        $payment_log = PaymentLog::query()
            ->where('payment_code', session(PAYMENT_CODE))
            ->first();
        $tour = Tour::query()->findOrFail($payment_log->tour_id);
        try {
            if ($request->get('vnp_ResponseCode') == '00') {
                if (session()->has(PAYMENT_CODE)) {
                    $invoice = Invoice::query()
                        ->where('payment_code', session(PAYMENT_CODE))
                        ->first();
                    $invoice->payment_status = PAYMENT_STATUS_SUCCESS;
                    $invoice->save();
                    $payment_log->vnp_Amount = $request->get('vnp_Amount');
                    $payment_log->vnp_BankCode = $request->get('vnp_BankCode');
                    $payment_log->vnp_BankTranNo = $request->get('vnp_BankTranNo');
                    $payment_log->vnp_CardType = $request->get('vnp_CardType');
                    $payment_log->vnp_OrderInfo = $request->get('vnp_OrderInfo');
                    $payment_log->vnp_PayDate = $request->get('vnp_PayDate');
                    $payment_log->vnp_ResponseCode = $request->get('vnp_ResponseCode');
                    $payment_log->vnp_SecureHash = $request->get('vnp_SecureHash');
                    $payment_log->vnp_PaymentMessage = $request->get('vnp_Command')
                        ? VNPayHelper::getPaymentMessage($request->get('vnp_Command'), $request->get('vnp_ResponseCode'))
                        : 'Thanh toán thành công';
                    $payment_log->save();
                }
                $message = 'Giao dịch thành công';
            } else {
                $message = 'Giao dịch thất bại';
            }
            return view('Main.checkout.confirmation', compact('message', 'payment_log'));
        } catch (\Exception $exception) {
            $error = 'Có lỗi xảy ra trong quá trình thanh toán';
            return redirect()->route('checkout.detail', ['slug' => $tour->slug, 'error' => $error]);
        }
    }

    public function checkTourExist($id, $batch)
    {
        $checkTourExist = PaymentLog::query()
            ->where('vnp_ResponseCode', '00')
            ->where('tour_id', $id)
            ->where('user_id', Auth::id())
            ->where('batch', $batch)
            ->first();
        return $checkTourExist ? response()->json(['exist' => true, 'invoice' => $checkTourExist], 409) : response()->json(['exist' => false, 'invoice' => $checkTourExist]);
    }
}
