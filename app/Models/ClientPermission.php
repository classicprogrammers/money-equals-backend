<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPermission extends Model
{
    use HasFactory;
    protected $table = 'user_permissions';
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
