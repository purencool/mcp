<?php

namespace App\Services;

class QrCode
{
    protected string $driver;

    public function __construct(string $driver = 'QrCode')
    {
        $this->driver = $driver;
    }

    public function generate(string $data): array
    {
        try {
            $writer = new \BaconQrCode\Writer();
            $qrCode = $writer->writeString($data);
            $path = storage_path("app/qr_" . md5($data) . ".png");
            $qrCode->save($path);
            return [
                "path" => $path,
                "data" => $data,
                "size" => filesize($path),
            ];
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function run(string $query): array
    {
        return $this->generate($query);
    }

}
