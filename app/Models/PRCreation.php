<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRCreation extends Model
{

    use HasFactory;
    protected $table='p_r_creations';
    protected $primaryKey='pr_number';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable=['id','date','pr_number','name_of_raw_matrial','quantity','quality','remarks'];

    public function po_creations(){
        return $this->hasMany(POCreation::class);
    }

}
