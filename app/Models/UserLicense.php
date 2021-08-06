<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLicense extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'plan_id', 'end_date'];
    
    public function plan(){
    	return $this->belongsTo(Plan::class);
    }
    public function customer(){
    	return $this->belongsTo(User::class, 'user_id');	
    }
}
