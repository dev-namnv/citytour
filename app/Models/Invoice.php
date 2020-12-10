<?php

namespace App\Models;

use App\Casts\Currency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'sku',
        'name',
        'sub_cost',
        'deposit_cost',
        'vat_cost',
        'total_cost',
        'address',
        'payment_type',
        'payment_code',
        'tour_id',
        'guide_id',
        'user_id',
        'start_date',
        'adult_count',
        'child_count',
        'customer_name',
        'customer_address',
        'customer_phone',
        'customer_email',
        'status'
    ];

    /**
     * TODO: Convert data
     *
     * @return mixed
     * @var integer string
     */

    public function getStatus()
    {
        $masterData = config('masterdata')['invoice'];
        return $masterData['status'][$this->status];
    }

    public function getColor()
    {
        $masterData = config('masterdata')['invoice'];
        return$masterData['color'][$this->status];
    }

    /**
     * TODO: Convert data
     *
     * @var string[]
     */
    protected $casts = [
        'sub_cost' => Currency::class,
        'vat_cost' => Currency::class,
        'total_cost' => Currency::class,
        'deposit_cost' => Currency::class
    ];

    /**
     * Eloquent invoice
     */
    public function invoice_detail()
    {
        return $this->hasOne('App\Models\InvoiceDetail');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function tour()
    {
        return $this->belongsTo('App\Models\Tour','tour_id')->withoutGlobalScopes();
    }

    public function guide()
    {
        return $this->belongsTo('App\Models\User', 'guide_id');
    }

    public function getEndDateAttribute()
    {
        return Carbon::createFromDate($this->start_date)->addDays((count($this->tour->schedules) - 1))->toDateString();
    }

    public function getDayAddFromStart($days)
    {
        return Carbon::createFromDate($this->start_date)->addDays($days)->format('d-m-Y');
    }

    public function calculateDaysDiff()
    {
        return today()->diffInDays(Carbon::createFromDate($this->start_date));
    }

    public function batch()
    {
        return $this->belongsTo('App\Models\Batch', 'start_date', 'id');
    }
}
