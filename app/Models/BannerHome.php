<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerHome extends Model
{
    public $table = 'alumni_banner_home';

    protected $guarded = [];
    
    use HasFactory;
}
