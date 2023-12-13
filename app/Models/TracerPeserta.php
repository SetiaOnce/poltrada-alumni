<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TracerPeserta extends Model
{
    public $table = 'tracer_peserta';
    
    public $timestamps = false;
    
    use HasFactory;
}
