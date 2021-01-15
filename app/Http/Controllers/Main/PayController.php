<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Mail\RefundPayment;
use App\Models\CancelPolicy;
use App\Models\Invoice;
use App\Models\Pay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PayController extends Controller
{
    public function request($id)
    {
        try {
            $invoice = Invoice::query()->where('user_id', Auth::id())->find($id);
            if (!$invoice) {
                return response()->json(['status' => TOASTR_INFO, 'content' => 'Không tìm thấy hóa đơn']);
            }
            $check_exist = Pay::query()->where('invoice_id', $id)->first();
            if ($check_exist) {
                return response()->json([
                    'status' => TOASTR_WARNING,
                    'title' => 'Exist',
                    'content' => 'Yêu cầu đã tồn tại'
                ]);
            }

            $cancel_policies = CancelPolicy::query()->orderBy('date', 'desc')->get();

            $cost = $invoice->getRawOriginal('deposit_cost');
            $url = env('VNP_SEARCH')
                .'&fromdate=' .Carbon::parse($invoice->created_at)->format('d-m-Y')
                .'&todate=' .Carbon::parse(now())->format('d-m-Y')
                .'&tnxref='.$invoice->payment_code
                .'&payType=&trace=&status=&desc=';
           if (Carbon::parse($invoice->created_at)->addHours(REFUND_HOURS) > Carbon::now()) {
                foreach ($cancel_policies as $policy) {
                    if (Carbon::parse($invoice->start_date)->diffInDays(Carbon::now()) >= $policy->date) {
                        $cost = $invoice->getRawOriginal('deposit_cost') * ($policy->refunds/100);
                        break;
                    }
                }
            }

            $newPay = new Pay([
                'invoice_id' => $invoice->id,
                'type' => PAY_TYPE_REFUND_TO_USER,
                'cost' => $cost,
                'url' => $url,
            ]);
            $newPay->save();

            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new RefundPayment($newPay));

            return response()->json(['status' => TOASTR_SUCCESS, 'content' => 'Đã gửi yêu cầu hoàn tiền']);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
