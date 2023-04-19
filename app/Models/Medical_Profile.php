<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_Profile extends Model
{
    use HasFactory;

    protected $table = 'medical_profile';
    protected $fillable = ['pdf' ,'patient_id'];

    public $timestamps =false;
}
