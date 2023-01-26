<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_number','invoice_Date','due_date','product','section','discount','rate_vat','value_vat','Total',
        'Status','value_status','value_status','note','user'];
}
