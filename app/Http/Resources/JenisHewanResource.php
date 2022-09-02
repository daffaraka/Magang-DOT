<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JenisHewanResource extends JsonResource
{
   
    // public function __construct($status, $message, $resource)
    // {
    //     parent::__construct($resource);
    //     $this->status  = $status;
    //     $this->message = $message;
    // }

  
    public function toArray($request)
    {
        return [
            'id_jenis_hewan' => $this->id_jenis_hewan,
            'nama_jenis' => $this->nama_jenis,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            // 'success'   => $this->status,
            // 'message'   => $this->message,
            // 'data'      => $this->resource
        ];
    }
}
