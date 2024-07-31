<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuMinumanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
          'id_menu_minuman' => $this->id,
            'nama_minuman' => $this->nama_minuman,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'gambar' => 'http://127.0.0.1:8000/storage/gambar/'.$this->gambar,
            'stock' => $this->stock,
            'created_at' => Carbon::parse($this->created_at)-> format("Y-m-d H:i:s"),
            'updated_at' => Carbon::parse($this->updated_at)-> format("Y-m-d H:i:s"),
        ];
    }
}
