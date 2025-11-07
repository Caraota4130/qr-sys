<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class QrCode extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'content',
        'color',
        'background_color',
        'size',
        'scan_count',
        'is_active'
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean'
    ];

    public function incrementScanCount()
    {
        $this->update(['scan_count' => $this->scan_count + 1]);
    }
}