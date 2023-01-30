<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_number','invoice_date','due_date','product','section','discount','rate_vat','value_vat',
        'amount_collection','amount_commission','total','status','value_status','note','user'];


    //==========================================================
    // RELATIONSHIPS============================================
    //==========================================================
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function attachment(){
        return $this->hasMany(Attachment::class,'invoice_id');
    }


    //==========================================================
    // Accessors================================================
    //==========================================================
//    protected function ValueStatus(): Attribute
//    {
//        return Attribute::make(
//            get: fn ($value) => function($value){
//                return match ($value) {
//                    3 => 'مدفوعة',
//                    2 => 'مدفوعة جزئيا',
//                    default => 'غير مدفوعة',
//                };
//            },
//        );
//    }
}
