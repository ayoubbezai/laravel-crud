<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;

    protected $keyType = "string"; //set the key type to UUID
    public $incrementing = false ; //disable auto incr

    public static function boot(){
        parent::boot();
        //auto generate the UUID
        static::creating(function($model){
            $model->id = Str::uuid();
        });
    }
    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "phone_number",
        "address",
        "birth_date",
    ];
}
