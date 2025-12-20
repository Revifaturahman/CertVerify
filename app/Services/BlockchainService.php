<?php

namespace App\Services;

use Exception;

class BlockchainService
{
    public static function storeHash(string $hash): array
    {
        $rpc      = env('BLOCKCHAIN_RPC');
        $contract = env('CONTRACT_ADDRESS');
        $pk       = env('PRIVATE_KEY');

        $script = base_path('blockchain/storeHash.cjs');

        $cmd = sprintf(
            'node "%s" 0x%s "%s" "%s" "%s"',
            $script,
            $hash,
            $rpc,
            $contract,
            $pk
        );

        $output = shell_exec($cmd);

        if (!$output) {
            throw new Exception('Tidak ada response dari blockchain');
        }

        $data = json_decode(trim($output), true);

        if (!isset($data['tx_hash'])) {
            throw new Exception('Response blockchain tidak valid');
        }

        return $data;
    }

    public static function verifyHash(string $hash): bool
{
    $rpc      = env('BLOCKCHAIN_RPC');
    $contract = env('CONTRACT_ADDRESS');

    $script = base_path('blockchain/verifyHash.cjs');

    $cmd = sprintf(
        'node "%s" 0x%s "%s" "%s"',
        $script,
        $hash,
        $rpc,
        $contract
    );

    $output = shell_exec($cmd);

    if (!$output) {
        throw new \Exception('Tidak ada response dari blockchain');
    }

    $data = json_decode(trim($output), true);

    if (!isset($data['exists'])) {
        throw new \Exception('Response blockchain tidak valid');
    }

    return (bool) $data['exists'];
}

}
