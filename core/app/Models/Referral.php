<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function referral()
    {
        return $this->belongsTo(User::class,'ref_id','id');
    }
}
