<?php

namespace App\Services;

class PdfParse
{
    protected string $driver;

    public function __construct(string $driver = 'PdfParse')
    {
        $this->driver = $driver;
    }

    public function parse(string $path): array
    {
        $path = realpath($path) ?: $path;
        if (!file_exists($path)) return ["error" => "File not found: $path"];

        try {
            $pdf = \Smalot\PdfParser\Parser::instance();
            $document = $pdf->parseFile($path);
            $text = $document->getText();
            return [
                "pages" => count($document->getPages()),
                "text" => mb_substr($text, 0, 20000),
            ];
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function run(string $query): array
    {
        return $this->parse($query);
    }

}
