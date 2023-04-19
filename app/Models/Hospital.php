<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;


    protected $table = 'hospitals';
    protected $fillable = ['name' , 'address','country_id'];

    protected $hidden  = ['created_at', 'updated_at'];



    public function country(){
        return $this->belongsTo('App\Models\Country' , 'country_id' , 'id');
    }

    public function doctors(){
        return $this -> hasMany('App\Models\Doctor', 'hospital_id' , 'id');
    }


}
