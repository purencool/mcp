<?php

namespace App\Services;

class Filesystem
{
    protected string $driver;

    public function __construct(string $driver = 'Filesystem')
    {
        $this->driver = $driver;
    }

    public function list(string $path): array
    {
        $path = realpath($path) ?: $path;
        if (!is_dir($path)) return ["error" => "Not a directory: $path"];
        $items = scandir($path);
        $result = [];
        foreach ($items as $item) {
            if ($item === "." || $item === "..") continue;
            $full = "$path/$item";
            $result[] = [
                "name" => $item,
                "type" => is_dir($full) ? "dir" : "file",
                "size" => is_file($full) ? filesize($full) : 0,
                "modified" => date("Y-m-d H:i:s", filemtime($full)),
            ];
        }
        return $result;
    }

    public function read(string $path): array
    {
        $path = realpath($path) ?: $path;
        if (!is_file($path)) return ["error" => "File not found: $path"];
        return ["content" => file_get_contents($path), "size" => filesize($path)];
    }

    public function write(string $path): array
    {
        // Not used via command — for internal agent use
        return ["error" => "Use read or list via command"];
    }

    public function search(string $query): array
    {
        $base = base_path();
        $results = [];
        $it = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($base, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($it as $file) {
            if (str_contains($file->getFilename(), $query)) {
                $results[] = $file->getPathname();
                if (count($results) >= 50) break;
            }
        }
        return $results;
    }

}
