<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    Protected $table='likefoto';
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
    public function foto()
    {
        return $this->belongsTo(Foto::class, 'fotoid', 'id');
    }
}
