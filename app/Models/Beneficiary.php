<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'country_id',
        'currency_id',
        'full_name',
        'business_name',
        'beneficiary_address',
        'email',
        'contact_no',
        'iban_account_no',
        'default_payment_reference',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
