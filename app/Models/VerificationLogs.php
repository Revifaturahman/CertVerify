<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationLogs extends Model
{
    protected $fillable = [
        'certificate_id',
        'input_certificate_id',
        'input_nim',
        'verified_by',
        'result',
        'verified_at',
        'ip_address'
    ];
}
