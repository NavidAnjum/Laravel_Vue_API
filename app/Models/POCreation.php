<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POCreation extends Model
{
    use HasFactory;
    protected $fillable=['date','po_number','lc_buyer','supplier' ,'lc_number','invoice' ,'bales' ,'total_kgs','name_of_mats'];
}
