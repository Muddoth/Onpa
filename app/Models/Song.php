<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'artist_name',
        'album',
        'genre',
        'file_path',
        'image_path'
    ];

    protected $casts = [
        'genre' => 'array',
    ];

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_song');
    }

}
