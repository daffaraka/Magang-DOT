<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAdopsi extends Model
{
    use HasFactory;

    protected $primaryKey  ='id_post_adopsi';

    protected $fillable =
    [
        'id_post_adopsi',
        'nama_post',
        'lokasi',
        'syarat_adopsi',
        'id_ras_hewan'
        
    ];

    public function RasHewan()
    {
        return $this->belongsTo(RasHewan::class,'id_ras_hewan');
    }
}
