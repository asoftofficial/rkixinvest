<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function magazine(){
        return $this->belongsTo(Magazine::class);
    }

    public function collection(){
        return $this->belongsTo(Collection::class);
    }
}
