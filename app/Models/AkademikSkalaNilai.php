<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkademikSkalaNilai extends Model
{
    public $table = 'akademik_skala_nilai';
    
    public $timestamps = false;
    
    use HasFactory;
}
