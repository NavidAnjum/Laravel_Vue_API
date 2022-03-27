<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class po_receive extends Model
{
    use HasFactory;
    protected $fillable=['po_number','date','tc_number','gmo'];
}
