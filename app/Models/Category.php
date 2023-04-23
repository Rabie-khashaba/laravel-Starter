<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $table = 'main_categories';
    protected $fillable = ['translate_lang' , 'translate_of' , 'name' , 'slog' , 'created_at' , 'updated_at'];
    protected $hidden = [ 'created_at' , 'updated_at'];

    public $timestamps = true;

}
