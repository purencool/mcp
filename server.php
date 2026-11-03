#!/usr/bin/env php
<?php
require __DIR__ . "/vendor/autoload.php";

$app = require_once __DIR__ . "/bootstrap/app.php";

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$command = $argv[1] ?? "";
$query = $argv[2] ?? "";
$driver = $argv[3] ?? null;
$arg4 = $argv[4] ?? null;

if (empty($command)) {
    fwrite(
        STDERR,
        json_encode(
            [
                "error" =>
                    "Usage: php server.php <command> <arg1> [arg2] [arg3]",
                "hint" => "Run: php server.php help",
            ],
            JSON_PRETTY_PRINT,
        ) . "\n",
    );
    exit(1);
}

switch ($command) {
    case "search":
        $args = ["query" => $query, "--json" => true];
        if ($driver) {
            $args["--driver"] = $driver;
        }
        Artisan::call("mcp:search", $args);
        break;

    case "weather":
        Artisan::call("mcp:weather", [
            "lat" => $query,
            "lng" => $driver ?: "151.2",
            "--json" => true,
        ]);
        break;

    case "countries":
        Artisan::call("mcp:countries", ["name" => $query, "--json" => true]);
        break;

    case "tavily":
        Artisan::call("mcp:tavily", ["query" => $query, "--json" => true]);
        break;

    case "exa":
        Artisan::call("mcp:exa", ["query" => $query, "--json" => true]);
        break;

    case "tinyfish":
        Artisan::call("mcp:tinyfish", ["query" => $query, "--json" => true]);
        break;

    case "wikipedia":
        Artisan::call("mcp:wikipedia", ["title" => $query, "--json" => true]);
        break;

    case "library":
        Artisan::call("mcp:library", ["query" => $query, "--json" => true]);
        break;

    case "news":
        Artisan::call("mcp:news", ["query" => $query, "--json" => true]);
        break;

    case "crypto":
        Artisan::call("mcp:crypto", [
            "coins" => $query,
            "--vs-currency" => $driver ?: "aud",
            "--json" => true,
        ]);
        break;

    case "exchange":
        Artisan::call("mcp:exchange", [
            "from" => $query,
            "to" => $driver ?: "AUD",
            "--json" => true,
        ]);
        break;

    case "geocode":
        Artisan::call("mcp:geocode", ["query" => $query, "--json" => true]);
        break;

    case "ip":
        Artisan::call("mcp:ip", ["address" => $query, "--json" => true]);
        break;

    case "github":
        Artisan::call("mcp:github", ["query" => $query, "--json" => true]);
        break;

    case "trivia":
        Artisan::call("mcp:trivia", [
            "--category" => $query ?: "9",
            "--difficulty" => $driver ?: "medium",
            "--json" => true,
        ]);
        break;

    case "sunrise":
        Artisan::call("mcp:sunrise", [
            "lat" => $query,
            "lng" => $driver ?: "151.2",
            "--json" => true,
        ]);
        break;

    case "holidays":
        Artisan::call("mcp:holidays", [
            "country" => $query,
            "--year" => $driver ?: date("Y"),
            "--json" => true,
        ]);
        break;

    case "images":
        Artisan::call("mcp:images", ["query" => $query, "--json" => true]);
        break;

    case "drivers":
        $available = array_keys(config("mcp.drivers"));
        $default = config("mcp.default");
        echo json_encode(["default" => $default, "available" => $available]) .
            "\n";
        exit(0);

    case "filesystem":
        Artisan::call("mcp:filesystem", [
            "query" => $driver ?: "list " . $query,
            "--json" => true,
        ]);
        break;

    case "code-exec":
        Artisan::call("mcp:code-exec", ["query" => $query, "--json" => true]);
        break;

    case "web-fetch":
        $args = ["query" => $query, "--json" => true];
        if ($driver) $args["--save"] = $driver;
        if ($arg4) $args["--save-json"] = $arg4;
        Artisan::call("mcp:web-fetch", $args);
        break;

    case "git":
        Artisan::call("mcp:git", ["query" => $query, "--json" => true]);
        break;

    case "database":
        Artisan::call("mcp:database", ["query" => $query, "--json" => true]);
        break;

    case "dns":
        Artisan::call("mcp:dns", ["query" => $query, "--json" => true]);
        break;

    case "system-info":
        Artisan::call("mcp:system-info", [
            "query" => $query ?: "all",
            "--json" => true,
        ]);
        break;

    case "http":
        Artisan::call("mcp:http", ["query" => $query, "--json" => true]);
        break;

    case "translate":
        Artisan::call("mcp:translate", ["query" => $query, "--json" => true]);
        break;

    case "stocks":
        Artisan::call("mcp:stocks", ["query" => $query, "--json" => true]);
        break;

    case "sports":
        Artisan::call("mcp:sports", ["query" => $query, "--json" => true]);
        break;

    case "maps":
        Artisan::call("mcp:maps", ["query" => $query, "--json" => true]);
        break;

    case "pdf":
        Artisan::call("mcp:pdf", ["query" => $query, "--json" => true]);
        break;

    case "ocr":
        Artisan::call("mcp:ocr", ["query" => $query, "--json" => true]);
        break;

    case "regex":
        // "/\d+/g 123abc456"
        Artisan::call("mcp:regex", ["query" => $query, "--json" => true]);
        break;

    case "json":
        Artisan::call("mcp:json", ["query" => $query, "--json" => true]);
        break;

    case "datetime":
        Artisan::call("mcp:datetime", ["query" => $query, "--json" => true]);
        break;

    case "units":
        Artisan::call("mcp:units", ["query" => $query, "--json" => true]);
        break;

    case "password":
        Artisan::call("mcp:password", ["query" => $query, "--json" => true]);
        break;

    case "qr":
        Artisan::call("mcp:qr", ["query" => $query, "--json" => true]);
        break;

    case "image-gen":
        Artisan::call("mcp:image-gen", ["query" => $query, "--json" => true]);
        break;

    case "tts":
        Artisan::call("mcp:tts", ["query" => $query, "--json" => true]);
        break;

    case "stt":
        Artisan::call("mcp:stt", ["query" => $query, "--json" => true]);
        break;

    case "email":
        Artisan::call("mcp:email", ["query" => $query, "--json" => true]);
        break;

    case "calendar":
        Artisan::call("mcp:calendar", ["query" => $query, "--json" => true]);
        break;

    case "webhook":
        // "https://hooks.example.com/trigger {\"key\":\"value\"}"
        Artisan::call("mcp:webhook", ["query" => $query, "--json" => true]);
        break;

    case "notify":
        Artisan::call("mcp:notify", ["query" => $query, "--json" => true]);
        break;

    case "memory":
        Artisan::call("mcp:memory", ["query" => $query, "--json" => true]);
        break;

    case "think":
        Artisan::call("mcp:think", ["query" => $query, "--json" => true]);
        break;

    case "firecrawl":
        Artisan::call("mcp:firecrawl", ["query" => $query, "--json" => true]);
        break;

    case "playwright":
        Artisan::call("mcp:playwright", ["query" => $query, "--json" => true]);
        break;

    case "help":
        $help = [
            "search" => 'php server.php search "query" [driver]',
            "weather" => "php server.php weather -33.87 151.21",
            "countries" => 'php server.php countries "Australia"',
            "tavily" => 'php server.php tavily "Laravel 12 features"',
            "exa" => 'php server.php exa "best PHP frameworks 2025"',
            "tinyfish" => 'php server.php tinyfish "MCP protocol"',
            "wikipedia" => 'php server.php wikipedia "Laravel"',
            "library" => 'php server.php library "Clean Code"',
            "news" => 'php server.php news "PHP 8.4"',
            "crypto" => 'php server.php crypto "bitcoin,ethereum" [currency]',
            "exchange" => "php server.php exchange USD AUD",
            "geocode" => 'php server.php geocode "Sydney"',
            "ip" => "php server.php ip 8.8.8.8",
            "github" => 'php server.php github "laravel mcp"',
            "trivia" => "php server.php trivia [category] [difficulty]",
            "sunrise" => "php server.php sunrise -33.87 151.21",
            "holidays" => "php server.php holidays AU [year]",
            "images" => 'php server.php images "sunset beach"',
            "drivers" => "php server.php drivers",
            "filesystem" =>
                'php server.php filesystem "/path/to/dir" [list|read|search]',
            "code-exec" => 'php server.php code-exec "ls -la"',
            "web-fetch" => 'php server.php web-fetch "https://example.com"',
            "git" => 'php server.php git "status"',
            "database" =>
                'php server.php database "SELECT * FROM users LIMIT 5"',
            "dns" => 'php server.php dns "dig example.com"',
            "system-info" =>
                "php server.php system-info [all|disk|memory|cpu|network]",
            "http" => 'php server.php http "GET https://api.example.com"',
            "translate" => 'php server.php translate "hello world"',
            "stocks" => 'php server.php stocks "AAPL"',
            "sports" => 'php server.php sports "football"',
            "maps" => "php server.php maps \"-33.87,151.21,-37.81,144.96\"",
            "pdf" => 'php server.php pdf "/path/to/file.pdf"',
            "ocr" => 'php server.php ocr "https://example.com/image.png"',
            "regex" => 'php server.php regex "/\\d+/g 123abc456"',
            "json" => 'php server.php json \'{"key":"value"}\'',
            "datetime" =>
                'php server.php datetime "2024-01-15 10:30 Australia/Sydney"',
            "units" => 'php server.php units "100 km to miles"',
            "password" => 'php server.php password "hash mypassword"',
            "qr" => 'php server.php qr "https://example.com"',
            "image-gen" => 'php server.php image-gen "a red fox in snow"',
            "tts" => 'php server.php tts "Hello world"',
            "stt" => 'php server.php stt "https://example.com/audio.mp3"',
            "email" => 'php server.php email "user@example.com"',
            "calendar" => 'php server.php calendar "meeting"',
            "webhook" =>
                'php server.php webhook "https://hooks.example.com {\"a\":1}"',
            "notify" => 'php server.php notify "Server is down"',
            "memory" => 'php server.php memory "remember this fact"',
            "think" => 'php server.php think "How do I solve X?"',
            "firecrawl" => 'php server.php firecrawl "https://example.com"',
            "playwright" => 'php server.php playwright "https://example.com"',
        ];

        echo json_encode(
            [
                "usage" => "php server.php <command> <args>",
                "commands" => $help,
            ],
            JSON_PRETTY_PRINT,
        ) . "\n";
        exit(0);

    default:
        fwrite(
            STDERR,
            json_encode(["error" => "Unknown command: {$command}"]) . "\n",
        );
        exit(1);
}

echo Artisan::output() . "\n";

