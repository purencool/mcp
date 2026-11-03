<?php

namespace App\Services;

class PasswordHash
{
    protected string $driver;

    public function __construct(string $driver = 'PasswordHash')
    {
        $this->driver = $driver;
    }

    public function generate(string $query): array
    {
        $mode = strtolower(explode(" ", $query)[0] ?? "hash");
        $input = trim(substr($query, strlen($mode) + 1)) ?: "password";

        $result = match($mode) {
            "hash" => ["type" => "bcrypt", "hash" => password_hash($input, PASSWORD_DEFAULT)],
            "argon2" => ["type" => "argon2", "hash" => password_hash($input, PASSWORD_ARGON2ID)],
            "md5" => ["type" => "md5", "hash" => md5($input)],
            "sha256" => ["type" => "sha256", "hash" => hash("sha256", $input)],
            "base64" => ["type" => "base64_encode", "hash" => base64_encode($input)],
            "base64_decode" => ["type" => "base64_decode", "hash" => base64_decode($input)],
            "url_encode" => ["type" => "url_encode", "hash" => urlencode($input)],
            "url_decode" => ["type" => "url_decode", "hash" => urldecode($input)],
            "random" => ["type" => "random", "hash" => bin2hex(random_bytes(16))],
            default => ["error" => "Mode: hash, argon2, md5, sha256, base64, base64_decode, url_encode, url_decode, random"],
        };

        return $result;
    }

    public function run(string $query): array
    {
        return $this->generate($query);
    }

}
