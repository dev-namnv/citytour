<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $table = 'payment_logs';

    protected $fillable = [
        'deposit_cost',
        'total_cost',
        'payment_type',
        'payment_code',
        'customer_name',
        'customer_email',
        'customer_phone',
        'vnp_Amount',
        'vnp_BankCode',
        'vnp_BankTranNo',
        'vnp_CardType',
        'vnp_OrderInfo',
        'vnp_PayDate',
        'vnp_ResponseCode',
        'vnp_SecureHash',
        'tour_id',
        'guide_id',
        'user_id',
    ];
}
