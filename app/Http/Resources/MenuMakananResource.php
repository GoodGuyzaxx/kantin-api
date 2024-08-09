<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuMakananResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_makanan' => $this->id_makanan,
            'id_kantin' =>$this->id_kantin,
            'nama_menu' => $this->nama_menu,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'gambar' => env('STORAGE_LOCATION').'storage/gambar/'.$this->gambar,
            'stock' => $this->stock,
            'created_at' => Carbon::parse($this->created_at)-> format("Y-m-d H:i:s"),
            'updated_at' => Carbon::parse($this->updated_at)-> format("Y-m-d H:i:s"),
        ];
//        return parent::toArray($request);
    }
}
