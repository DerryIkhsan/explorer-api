<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder_id',
        'file',
        'file_hash',
        'type',
        'size',
    ];

    protected function fileHash(): Attribute{
        return Attribute::make(
            get: fn($fileHash) => url('/storage/files/'.$fileHash)
        );
    }
}
