<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockchainRecord extends Model
{
    protected $fillable = [
        'certificate_id',
        'tx_hash',
        'block_number',
        'network'
    ];
}
