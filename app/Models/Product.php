<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','section_id'];






    //==========================================================
    //===================RELATIONSHIPS==========================
    //==========================================================
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }

}
