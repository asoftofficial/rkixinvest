<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = ['bannerId', 'plan_id', 'name', 'type', 'start_date', 'end_date', 'file_path', 'display_area'];
}
