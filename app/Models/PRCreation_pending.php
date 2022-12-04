<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRCreation_pending extends Model
{
    use HasFactory;

    protected $fillable = ['date','pr_number','name_of_raw_matrial','l_quantity','s_quantity','m_quantity','remarks','approval'];
}
