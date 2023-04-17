<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';
    protected $fillable = ['name' , 'title' ,'gender', 'hospital_id'];
    protected $hidden  = ['created_at', 'updated_at' ,'hospital_id','pivot'];


        public function hospital(){
        return $this ->belongsTo('App\Models\Hospital' , 'hospital_id' , 'id');
    }

    public function services(){
        return $this->belongsToMany('App\Models\Service' ,'App\Models\Doctor_Service' ,'doctor_id','service_id','id','id');
    }

}
