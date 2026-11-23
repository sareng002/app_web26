<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tb_kec extends Model
{
    //
    protected $table = 'tb_kec';
    protected $fillable = [
        'nkk',
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'sts_kawin',
        'kelamin',
        'alamat',
        'kecamatan'
    ];
}
