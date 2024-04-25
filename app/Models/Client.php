<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function fxRequirement()
    {
        return $this->hasOne(ClientFxRequirement::class);
    }
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }
    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
}
