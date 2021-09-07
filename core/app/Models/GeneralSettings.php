<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = ['email_config' => 'object','sms_config' => 'object'];
}
