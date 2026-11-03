<?php

return [
    "default" => env("SEARCH_DEFAULT", "search"),

    "drivers" => [
        env("SEARCH_DRIVER") => [
            "endpoint" => env("SEARCH_ENDPOINT"),
            "api_key" => env("SEARCH_API"),
            "auth_type" => env("SEARCH_AUTH_TYPE", "none"),
            "header_name" => env("SEARCH_HEADER_NAME"),
            "params" => array_filter(explode("&", env("SEARCH_PARAMS", ""))),
            "header_string" => env("SEARCH_HEADER_STRING", ""),
        ],
        env("SEARCH_TWO_DRIVER") => [
            "endpoint" => env("SEARCH_TWO_ENDPOINT"),
            "api_key" => env("SEARCH_TWO_API"),
            "auth_type" => env("SEARCH_TWO_AUTH_TYPE", "none"),
            "header_name" => env("SEARCH_TWO_HEADER_NAME"),
            "params" => array_filter(
                explode("&", env("SEARCH_TWO_PARAMS", "")),
            ),
            "header_string" => env("SEARCH_TWO_HEADER_STRING", ""),
        ],
        env("SEARCH_THREE_DRIVER") => [
            "endpoint" => env("SEARCH_THREE_ENDPOINT"),
            "api_key" => env("SEARCH_THREE_API"),
            "auth_type" => env("SEARCH_THREE_AUTH_TYPE", "none"),
            "header_name" => env("SEARCH_THREE_HEADER_NAME"),
            "params" => array_filter(
                explode("&", env("SEARCH_THREE_PARAMS", "")),
            ),
            "header_string" => env("SEARCH_THREE_HEADER_STRING", ""),
        ],
        env("SEARCH_FOUR_DRIVER") => [
            "endpoint" => env("SEARCH_FOUR_ENDPOINT"),
            "api_key" => env("SEARCH_FOUR_API"),
            "auth_type" => env("SEARCH_FOUR_AUTH_TYPE", "none"),
            "header_name" => env("SEARCH_FOUR_HEADER_NAME"),
            "params" => array_filter(
                explode("&", env("SEARCH_FOUR_PARAMS", "")),
            ),
            "header_string" => env("SEARCH_FOUR_HEADER_STRING", ""),
        ],

        "weather" => [
            "endpoint" => env(
                "WEATHER_ENDPOINT",
                "https://api.open-meteo.com/v1/forecast",
            ),
            "api_key" => env("WEATHER_API", ""),
            "auth_type" => env("WEATHER_AUTH_TYPE", "none"),
            "header_name" => env("WEATHER_HEADER_NAME", ""),
            "header_string" => env("WEATHER_HEADER_STRING", ""),
        ],
        "countries" => [
            "endpoint" => env(
                "COUNTRIES_ENDPOINT",
                "https://restcountries.com/v3.1/name/",
            ),
            "api_key" => env("COUNTRIES_API", ""),
            "auth_type" => env("COUNTRIES_AUTH_TYPE", "none"),
            "header_name" => env("COUNTRIES_HEADER_NAME", ""),
            "header_string" => env("COUNTRIES_HEADER_STRING", ""),
        ],
        "tavily" => [
            "endpoint" => env(
                "TAVILY_ENDPOINT",
                "https://api.tavily.com/search",
            ),
            "api_key" => env("TAVILY_API", ""),
            "auth_type" => env("TAVILY_AUTH_TYPE", "bearer"),
            "header_name" => env("TAVILY_HEADER_NAME", ""),
            "header_string" => env("TAVILY_HEADER_STRING", ""),
        ],
        "exa" => [
            "endpoint" => env("EXA_ENDPOINT", "https://api.exa.ai/search"),
            "api_key" => env("EXA_API", ""),
            "auth_type" => env("EXA_AUTH_TYPE", "bearer"),
            "header_name" => env("EXA_HEADER_NAME", ""),
            "header_string" => env("EXA_HEADER_STRING", ""),
        ],
        "tinyfish" => [
            "endpoint" => env(
                "TINYFISH_ENDPOINT",
                "https://api.search.tinyfish.ai",
            ),
            "api_key" => env("TINYFISH_API", ""),
            "auth_type" => env("TINYFISH_AUTH_TYPE", "bearer"),
            "header_name" => env("TINYFISH_HEADER_NAME", ""),
            "header_string" => env("TINYFISH_HEADER_STRING", ""),
        ],
        "wikipedia" => [
            "endpoint" => env(
                "WIKIPEDIA_ENDPOINT",
                "https://en.wikipedia.org/api/rest_v1/page/summary/",
            ),
            "api_key" => env("WIKIPEDIA_API", ""),
            "auth_type" => env("WIKIPEDIA_AUTH_TYPE", "none"),
            "header_name" => env("WIKIPEDIA_HEADER_NAME", ""),
            "header_string" => env("WIKIPEDIA_HEADER_STRING", ""),
        ],
        "library" => [
            "endpoint" => env(
                "LIBRARY_ENDPOINT",
                "https://openlibrary.org/search.json",
            ),
            "api_key" => env("LIBRARY_API", ""),
            "auth_type" => env("LIBRARY_AUTH_TYPE", "none"),
            "header_name" => env("LIBRARY_HEADER_NAME", ""),
            "header_string" => env("LIBRARY_HEADER_STRING", ""),
        ],
        "news" => [
            "endpoint" => env(
                "NEWS_ENDPOINT",
                "https://hn.algolia.com/api/v1/search",
            ),
            "api_key" => env("NEWS_API", ""),
            "auth_type" => env("NEWS_AUTH_TYPE", "none"),
            "header_name" => env("NEWS_HEADER_NAME", ""),
            "header_string" => env("NEWS_HEADER_STRING", ""),
        ],
        "crypto" => [
            "endpoint" => env(
                "CRYPTO_ENDPOINT",
                "https://api.coingecko.com/api/v3/simple/price",
            ),
            "api_key" => env("CRYPTO_API", ""),
            "auth_type" => env("CRYPTO_AUTH_TYPE", "none"),
            "header_name" => env("CRYPTO_HEADER_NAME", ""),
            "header_string" => env("CRYPTO_HEADER_STRING", ""),
        ],
        "exchange" => [
            "endpoint" => env(
                "EXCHANGE_ENDPOINT",
                "https://api.frankfurter.app/latest",
            ),
            "api_key" => env("EXCHANGE_API", ""),
            "auth_type" => env("EXCHANGE_AUTH_TYPE", "none"),
            "header_name" => env("EXCHANGE_HEADER_NAME", ""),
            "header_string" => env("EXCHANGE_HEADER_STRING", ""),
        ],
        "geocode" => [
            "endpoint" => env(
                "GEOCODE_ENDPOINT",
                "https://nominatim.openstreetmap.org/search",
            ),
            "api_key" => env("GEOCODE_API", ""),
            "auth_type" => env("GEOCODE_AUTH_TYPE", "none"),
            "header_name" => env("GEOCODE_HEADER_NAME", ""),
            "header_string" => env(
                "GEOCODE_HEADER_STRING",
                "User-Agent: mcp-agent/1.0",
            ),
        ],
        "ip" => [
            "endpoint" => env("IP_ENDPOINT", "https://ipinfo.io/"),
            "api_key" => env("IP_API", ""),
            "auth_type" => env("IP_AUTH_TYPE", "none"),
            "header_name" => env("IP_HEADER_NAME", ""),
            "header_string" => env("IP_HEADER_STRING", ""),
        ],
        "github" => [
            "endpoint" => env(
                "GITHUB_ENDPOINT",
                "https://api.github.com/search/repositories",
            ),
            "api_key" => env("GITHUB_API", ""),
            "auth_type" => env("GITHUB_AUTH_TYPE", "header"),
            "header_name" => env("GITHUB_HEADER_NAME", "Authorization"),
            "header_string" => env("GITHUB_HEADER_STRING", ""),
        ],
        "trivia" => [
            "endpoint" => env("TRIVIA_ENDPOINT", "https://opentdb.com/api.php"),
            "api_key" => env("TRIVIA_API", ""),
            "auth_type" => env("TRIVIA_AUTH_TYPE", "none"),
            "header_name" => env("TRIVIA_HEADER_NAME", ""),
            "header_string" => env("TRIVIA_HEADER_STRING", ""),
        ],
        "sunrise" => [
            "endpoint" => env(
                "SUNRISE_ENDPOINT",
                "https://api.sunrise-sunset.org/json",
            ),
            "api_key" => env("SUNRISE_API", ""),
            "auth_type" => env("SUNRISE_AUTH_TYPE", "none"),
            "header_name" => env("SUNRISE_HEADER_NAME", ""),
            "header_string" => env("SUNRISE_HEADER_STRING", ""),
        ],
        "holidays" => [
            "endpoint" => env(
                "HOLIDAYS_ENDPOINT",
                "https://date.nager.at/api/v3/PublicHolidays/",
            ),
            "api_key" => env("HOLIDAYS_API", ""),
            "auth_type" => env("HOLIDAYS_AUTH_TYPE", "none"),
            "header_name" => env("HOLIDAYS_HEADER_NAME", ""),
            "header_string" => env("HOLIDAYS_HEADER_STRING", ""),
        ],
        "images" => [
            "endpoint" => env(
                "IMAGES_ENDPOINT",
                "https://api.pexels.com/v1/search",
            ),
            "api_key" => env("IMAGES_API", ""),
            "auth_type" => env("IMAGES_AUTH_TYPE", "header"),
            "header_name" => env("IMAGES_HEADER_NAME", "Authorization"),
            "header_string" => env("IMAGES_HEADER_STRING", ""),
        ],
        "translation" => [
            "endpoint" => env(
                "TRANSLATION_ENDPOINT",
                "https://api.mymemory.translated.net/get",
            ),
            "api_key" => env("TRANSLATION_API", ""),
            "auth_type" => env("TRANSLATION_AUTH_TYPE", "none"),
            "header_name" => env("TRANSLATION_HEADER_NAME", ""),
            "header_string" => env("TRANSLATION_HEADER_STRING", ""),
        ],
        "stocks" => [
            "endpoint" => env(
                "STOCKS_ENDPOINT",
                "https://query1.finance.yahoo.com/v8/finance/chart/",
            ),
            "api_key" => env("STOCKS_API", ""),
            "auth_type" => env("STOCKS_AUTH_TYPE", "none"),
            "header_name" => env("STOCKS_HEADER_NAME", ""),
            "header_string" => env("STOCKS_HEADER_STRING", ""),
        ],
        "sports" => [
            "endpoint" => env("SPORTS_ENDPOINT", ""),
            "api_key" => env("SPORTS_API", ""),
            "auth_type" => env("SPORTS_AUTH_TYPE", "none"),
            "header_name" => env("SPORTS_HEADER_NAME", ""),
            "header_string" => env("SPORTS_HEADER_STRING", ""),
            "query_param" => "e",
        ],
        "maps" => [
            "endpoint" => env(
                "MAPS_ENDPOINT",
                "https://router.openstreetmap.org/route/v1/driving/",
            ),
            "api_key" => env("MAPS_API", ""),
            "auth_type" => env("MAPS_AUTH_TYPE", "none"),
            "header_name" => env("MAPS_HEADER_NAME", ""),
            "header_string" => env("MAPS_HEADER_STRING", ""),
        ],
        "ocr" => [
            "endpoint" => env(
                "OCR_ENDPOINT",
                "https://api.ocr.space/parse/image",
            ),
            "api_key" => env("OCR_API", ""),
            "auth_type" => env("OCR_AUTH_TYPE", "header"),
            "header_name" => env("OCR_HEADER_NAME", "OcrApiKey"),
            "header_string" => env("OCR_HEADER_STRING", ""),
        ],
        "image-gen" => [
            "endpoint" => env(
                "IMAGE_GEN_ENDPOINT",
                "https://api.stability.ai/v1/generations",
            ),
            "api_key" => env("IMAGE_GEN_API", ""),
            "auth_type" => env("IMAGE_GEN_AUTH_TYPE", "bearer"),
            "header_name" => env("IMAGE_GEN_HEADER_NAME", ""),
            "header_string" => env("IMAGE_GEN_HEADER_STRING", ""),
        ],
        "tts" => [
            "endpoint" => env(
                "TTS_ENDPOINT",
                "https://api.elevenlabs.io/v1/text-to-speech",
            ),
            "api_key" => env("TTS_API", ""),
            "auth_type" => env("TTS_AUTH_TYPE", "bearer"),
            "header_name" => env("TTS_HEADER_NAME", ""),
            "header_string" => env("TTS_HEADER_STRING", ""),
        ],
        "stt" => [
            "endpoint" => env(
                "STT_ENDPOINT",
                "https://api.assemblyai.com/v2/transcriptions",
            ),
            "api_key" => env("STT_API", ""),
            "auth_type" => env("STT_AUTH_TYPE", "bearer"),
            "header_name" => env("STT_HEADER_NAME", ""),
            "header_string" => env("STT_HEADER_STRING", ""),
        ],
        "email" => [
            "endpoint" => env(
                "EMAIL_ENDPOINT",
                "https://api.mailgun.net/api/v2",
            ),
            "api_key" => env("EMAIL_API", ""),
            "auth_type" => env("EMAIL_AUTH_TYPE", "basic"),
            "header_name" => env("EMAIL_HEADER_NAME", ""),
            "header_string" => env("EMAIL_HEADER_STRING", ""),
        ],
        "calendar" => [
            "endpoint" => env(
                "CALENDAR_ENDPOINT",
                "https://www.googleapis.com/calendar/v3/calendars/primary/events",
            ),
            "api_key" => env("CALENDAR_API", ""),
            "auth_type" => env("CALENDAR_AUTH_TYPE", "bearer"),
            "header_name" => env("CALENDAR_HEADER_NAME", ""),
            "header_string" => env("CALENDAR_HEADER_STRING", ""),
        ],
        "notify" => [
            "endpoint" => env("NOTIFY_ENDPOINT", "https://ntfy.sh/"),
            "api_key" => env("NOTIFY_API", ""),
            "auth_type" => env("NOTIFY_AUTH_TYPE", "none"),
            "header_name" => env("NOTIFY_HEADER_NAME", ""),
            "header_string" => env("NOTIFY_HEADER_STRING", ""),
        ],
        "firecrawl" => [
            "endpoint" => env(
                "FIRECRAWL_ENDPOINT",
                "https://api.firecrawl.dev/v0/scrape",
            ),
            "api_key" => env("FIRECRAWL_API", ""),
            "auth_type" => env("FIRECRAWL_AUTH_TYPE", "bearer"),
            "header_name" => env("FIRECRAWL_HEADER_NAME", ""),
            "header_string" => env("FIRECRAWL_HEADER_STRING", ""),
        ],
    ],
];
