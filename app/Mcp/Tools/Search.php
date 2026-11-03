<?php

namespace App\Mcp\Tools;

use App\Contracts\Searchable;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Description;

#[Name("search")]
#[Description("Search the web for information.")]
class Search extends Tool
{
    public function __construct(private Searchable $search) {}

    public function handle(Request $request): Response
    {
        $query = $request->get("query");
        $result = $this->search->search($query);

        return Response::json($result);
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            "query" => $schema
                ->string()
                ->description("The search query.")
                ->required(),
        ];
    }
}
