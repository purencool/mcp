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
    ],
];
