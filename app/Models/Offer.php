<?php

namespace App\Models;

use App\Scopes\OfferScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Offer extends Model
{
    use HasFactory;

    //if the name of model not match
    protected $table = 'offers';
    // fillable is the white box (allowed)
    protected $fillable = ['image','name_ar','name_en','price','details_ar','details_en','status','created_at','updated_at'];
    protected $hidden = ['created_at' , 'updated_at'];

    //to make laravel not inserted  'created_at' , 'updated_at'
    //public $timestamps = false;


    //register global scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OfferScopes);
    }

    //local scope
    public function scopeInactive($query){
        return $query -> where('status' , 0);
    }

    public function scopeInValid($query){
        return $query->where('status',0)->whereNull('details_ar');
    }


    //Mutators

    public function setNameEnAttribute($value){
        $this ->attributes['name_en'] = strtoupper($value);
    }

}


