<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_payment extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id','collection_amount','payment_status' ,'user_id','note','remaining_amount','total'];

    //==========================================================
    // RELATIONSHIPS============================================
    //==========================================================
    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
