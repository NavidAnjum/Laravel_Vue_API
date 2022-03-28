<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POCreation extends Model
{
    use HasFactory;
    protected $primaryKey='po_number';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable=['id','pr_number','date','po_number','lc_buyer','supplier' ,'lc_number','invoice' ,'bales' ,'total_kgs','name_of_mats'];
    public function pr_creaton(){
        return $this->belongsTo(PRCreation::class,'po_number','pr_number');
    }
}
