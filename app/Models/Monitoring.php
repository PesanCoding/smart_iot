<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;
    protected $table = "sensors";
    protected $guarded = [];
    public function user()
       {
           return $this->belongsTo(User::class,'id_user');
       }
}
