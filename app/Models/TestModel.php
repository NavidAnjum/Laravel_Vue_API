<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    use HasFactory;
    protected $primaryKey='po_number';
    public $incrementing = false;
    protected $keyType = 'string';


    public function pr_creatons(){
        return $this->belongsTo(PRCreation::class,'pr_number');
    }
}
