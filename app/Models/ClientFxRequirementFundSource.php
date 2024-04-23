<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientFxRequirementFundSource extends Model
{
    use HasFactory;
    protected $table = 'client_fx_requirement_fund_source';

    public function clientFxRequirement()
    {
        return $this->belongsTo(ClientFxRequirement::class, 'client_fx_requirement_id');
    }
}
