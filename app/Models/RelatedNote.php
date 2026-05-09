<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedNote extends Model
{
    use HasFactory;

    protected $table = 'related_notes';

    protected $fillable = [
        'video_id',
        'related_notes',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}