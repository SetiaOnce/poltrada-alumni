<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkademikPenerbitTranskip extends Model
{
    public $table = 'akademik_penerbitan_transkrip';
    
    public $timestamps = false;
    
    use HasFactory;
    
    public function kurikulum()
    {
        $this->belongsTo(AkademikKurikulum::class, 'kurikulum_id', 'id');
    }
}
