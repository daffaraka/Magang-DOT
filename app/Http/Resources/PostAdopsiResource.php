<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostAdopsiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_post_adopsi' => $this->id_post_adopsi,
            'nama_post' => $this->nama_post,
            'lokasi' => $this->lokasi,
            'syarat_adopsi' => $this->syarat_adopsi,
            'id_ras_hewan' => $this->RasHewan,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            // 'success'   => $this->status,
            // 'message'   => $this->message,
            // 'data'      => $this->resource
        ];
    }
}
