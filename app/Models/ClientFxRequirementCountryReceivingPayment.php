<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientFxRequirementCountryReceivingPayment extends Model
{
    use HasFactory;
    protected $table = 'client_fx_requirement_countries_receiving_payment';

    public function clientFxRequirement()
    {
        return $this->belongsTo(ClientFxRequirement::class, 'client_fx_requirement_id');
    }
}
