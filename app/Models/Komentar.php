<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    Protected $table='komentarfoto';
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
