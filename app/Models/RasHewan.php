<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasHewan extends Model
{
    use HasFactory;

    use HasFactory;

    protected $primaryKey = 'id_ras_hewan';

  
    protected $fillable =
    [
        'nama_ras',
        'asal_ras',
        'id_jenis_hewan'
    ];

    public function JenisHewan()
    {
        return $this->belongsTo(JenisHewan::class,'id_jenis_hewan');
    }
}
