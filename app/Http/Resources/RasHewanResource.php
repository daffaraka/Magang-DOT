<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RasHewanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_ras_hewan' => $this->id_ras_hewan,
            'nama_ras' => $this->nama_ras,
            'asal_ras' => $this->asal_ras,
            'id_jenis_hewan' => $this->JenisHewan,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            // 'success'   => $this->status,
            // 'message'   => $this->message,
            // 'data'      => $this->resource
        ];
    }
}
