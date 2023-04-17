<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';
    protected $fillable = ['name' , 'title' ,'gender', 'hospital_id'];
    protected $hidden  = ['created_at', 'updated_at' ,'hospital_id'];


    public function hospital(){
        return $this ->belongsTo('App\Models\Hospital' , 'hospital_id' , 'id');
    }

}
