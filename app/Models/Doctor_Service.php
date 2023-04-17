<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_Service extends Model
{
    use HasFactory;
    protected $table = 'doctor_service';
    protected  $fillable = ['doctor_id' , 'service_id'];


}
