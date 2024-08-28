<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function deposits(){
        return $this->hasMany(Deposite::class);
    }

    public function expenses(){
        return $this->hasMany(CustomerExpense::class);
    }

    public function images(){
        return $this->hasMany(CustomerImage::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
