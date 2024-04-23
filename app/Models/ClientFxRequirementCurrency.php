<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientFxRequirementCurrency extends Model
{
    use HasFactory;
    protected $table = 'client_fx_requirement_currency';

    protected $fillable = [
        'client_fx_requirement_id',
        'currency_id'
    ];

    // Define the relationships
    public function clientFxRequirement()
    {
        return $this->belongsTo(ClientFxRequirement::class, 'client_fx_requirement_id');
    }
}
