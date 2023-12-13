<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    public $table = 'alumni_kegiatan';
    
    protected $guarded = [];
    
    use HasFactory;
}
