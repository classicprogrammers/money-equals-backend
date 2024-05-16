<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $table = 'deals';
    protected $fillable = [
        'beneficiary_id',
        'total_payable_amount',
        'payment_reference',
        'suggested_exchange_rate',
        'total_fees',
        'unique_identifier',
        'amount_currency'
    ];
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
