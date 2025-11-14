<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $user = auth()->user();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'album' => $this->album,
            'genre' => $this->genre,
            'image_path' => $this->image_path,
            'file_path' => $this->file_path,
            'artist' => [
                'id' => $this->artist->id ?? null,
                'name' =>  $this->artist->name ?? 'Unknown Artist',
            ],
            // Add permission flags per song
            'role' => $user,
            'can_update' => $user ? $user->can('update', $this->resource) : false,
            'can_delete' => $user ? $user->can('delete', $this->resource) : false,

        ];
    }
}
