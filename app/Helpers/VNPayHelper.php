<?php

namespace App\Helpers;

class VNPayHelper
{
    public static function getPaymentMessage($vnp_Command, $vnp_ResponseCode)
    {
        $message_data = [
            'pay' => [
                '00' => 'Giao dịch thành công',
                '01' => 'Giao dịch đã tồn tại',
                '02' => 'Merchant không hợp lệ (kiểm tra lại vnp_TmnCode)',
                '03' => 'Dữ liệu gửi sang không đúng định dạng',
                '04' => 'Khởi tạo GD không thành công do Website đang bị tạm khóa',
                '05' => 'Giao dịch không thành công do: Quý khách nhập sai mật khẩu quá số lần quy định. Xin quý khách vui lòng thực hiện lại giao dịch',
                '13' => 'Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch.',
                '07' => 'Giao dịch bị nghi ngờ là giao dịch gian lận',
                '09' => 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng.',
                '10' => 'Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần',
                '11' => 'Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch.',
                '12' => 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng bị khóa.',
                '51' => 'Giao dịch không thành công do: Tài khoản của quý khách không đủ số dư để thực hiện giao dịch.',
                '65' => 'Giao dịch không thành công do: Tài khoản của Quý khách đã vượt quá hạn mức giao dịch trong ngày.',
                '08' => 'Giao dịch không thành công do: Hệ thống Ngân hàng đang bảo trì. Xin quý khách tạm thời không thực hiện giao dịch bằng thẻ/tài khoản của Ngân hàng này.',
                '99' => 'Giao dịch không thành công, lỗi không xác định'
            ],
            'querydr' => [
                '91' => 'Không tìm thấy giao dịch yêu cầu',
                '02' => 'Merchant không hợp lệ (kiểm tra lại vnp_TmnCode)',
                '03' => 'Dữ liệu gửi sang không đúng định dạng',
                '08' => 'Hệ thống đang bảo trì',
                '97' => 'Chữ ký không hợp lệ',
                '99' => 'Giao dịch không thành công, lỗi không xác định'
            ],
            'refund' => [
                '91' => 'Không tìm thấy giao dịch yêu cầu hoàn trả',
                '02' => 'Merchant không hợp lệ (kiểm tra lại vnp_TmnCode)',
                '03' => 'Dữ liệu gửi sang không đúng định dạng',
                '08' => 'Hệ thống đang bảo trì',
                '93' => 'Số tiền hoàn trả không hợp lệ. Số tiền hoàn trả phải nhỏ hơn hoặc bằng số tiền thanh toán.',
                '94' => 'Giao dịch đã được gửi yêu cầu hoàn tiền trước đó. Yêu cầu này VNPAY đang xử lý',
                '95' => 'Giao dịch này không thành công bên VNPAY. VNPAY từ chối xử lý yêu cầu.',
                '97' => 'Chữ ký không hợp lệ',
                '99' => 'Giao dịch không thành công, lỗi không xác định'
            ]
        ];
        return $message_data[$vnp_Command][$vnp_ResponseCode]
            ? $message_data[$vnp_Command][$vnp_ResponseCode]
            : 'Giao dịch không thành công, lỗi không xác định';
    }
}
