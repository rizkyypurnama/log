<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    Protected $table='foto';
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
    public function album()
    {
        return $this->belongsTo(Album::class, 'albumid', 'id');
    }
    public function like()
    {
        return $this->hasMany(Like::class, 'fotoid', 'id');
    }
}
