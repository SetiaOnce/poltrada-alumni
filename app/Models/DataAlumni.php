<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class DataAlumni extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $table = 'alumni_data_alumni';
    
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_prodi',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'negara_id',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
        'alamat',
        'telp',
        'agama',
        'jenis_kelamin',
        'email',
        'password',
        'nim',
        'nik',
        'nisn',
        'npwp',
        'foto',
        'koor_lat',
        'koor_long',
        'angkatan',
        'instansi_kerja',
        'uuid',
    ];
    public function provinsi()
    {
    	return $this->belongsTo('App\Models\GroupProvinsi', 'provinsi_id', 'id'); 
    } 
    public function prodi()
    {
    	return $this->belongsTo('App\Models\AkademikProdi', 'kode_prodi', 'kode_prodi'); 
    } 
    public function kabupaten()
    {
    	return $this->belongsTo('App\Models\GroupKabupaten', 'kabupaten_id', 'id'); 
    } 
}
