<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jenis_hewan';

    protected $fillable =
    [
        'nama_jenis',
    ];

    public function RasHewan()
    {
        return $this->hasMany(RasHewan::class);
    }
}
