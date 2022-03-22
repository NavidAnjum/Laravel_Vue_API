<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRCreation extends Model
{

    use HasFactory;

    protected $fillable=['date','pr_number','name_of_raw_matrial','quantity','quality','remarks'];
}
