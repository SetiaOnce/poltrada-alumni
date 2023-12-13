<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkademikKurikulum extends Model
{
    public $table = 'akademik_kurikulum';
    
    public $timestamps = false;
    
    use HasFactory;
}
