<?php

use App\Mcp\Servers\McpServerService;
use Laravel\Mcp\Facades\Mcp;

Mcp::web('/mcp', McpServerService::class);
