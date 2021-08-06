<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    public $table = 'reward';
    use HasFactory;
    protected $guarded = [];
}
