<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $table = 'deals';
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
