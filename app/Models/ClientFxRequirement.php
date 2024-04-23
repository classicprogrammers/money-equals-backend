<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientFxRequirement extends Model
{
    use HasFactory;
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function currencies()
    {
        return $this->hasMany(ClientFxRequirementCurrency::class, 'client_fx_requirement_id');
    }
    public function countriesMakingPayment()
    {
        return $this->hasMany(ClientFxRequirementCountryMakingPayment::class, 'client_fx_requirement_id');
    }
    public function countriesReceivingPayment()
    {
        return $this->hasMany(ClientFxRequirementCountryReceivingPayment::class, 'client_fx_requirement_id');
    }
    public function fundSources()
    {
        return $this->hasMany(ClientFxRequirementFundSource::class, 'client_fx_requirement_id');
    }
    public function paymentPurposes()
    {
        return $this->hasMany(ClientFxRequirementPaymentPurpose::class, 'client_fx_requirement_id');
    }

}
