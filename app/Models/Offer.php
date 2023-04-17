<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    //if the name of model not match
    protected $table = 'offers';
    // fillable is the white box (allowed)
    protected $fillable = ['image','name_ar','name_en','price','details_ar','details_en','created_at','updated_at'];
    protected $hidden = ['created_at' , 'updated_at'];

    //to make laravel not inserted  'created_at' , 'updated_at'
    //public $timestamps = false;

}


