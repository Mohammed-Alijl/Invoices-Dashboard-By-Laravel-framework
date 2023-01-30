<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'file_name'
    ];

    //==========================================================
    // RELATIONSHIPS============================================
    //==========================================================
    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
