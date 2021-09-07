<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'front', 'status' , 'stripe_id', 'partner_name', 'file_path', 'text'];

    public function magzines(){
        return $this->belongsToMany(Magzine::class);
    }
    public function licenses(){
    	return $this->hasMany(UserLicense::class);
    }
    public function promotions(){
        return $this->hasMany(Promotion::class);
    }
}
