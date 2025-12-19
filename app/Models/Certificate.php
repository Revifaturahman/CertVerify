<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'certificate_id',
        'nim',
        'name',
        'event_name',
        'template_name',
        'issued_at',
        'status',
        'hash_value'
    ];

    protected $casts = [
        'issued_at' => 'date'
    ];
}
