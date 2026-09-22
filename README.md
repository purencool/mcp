

### Test.

##### Start
```
php artisan serve --host=127.0.0.1 --port=8000
```

```
php artisan mcp:inspector mcp
```

```
php artisan route:list | grep mcp
```

```
curl -i http://127.0.0.1:8000/mcp
```

```
curl -i \
  -X POST http://127.0.0.1:8000/mcp \
  -H "Content-Type: application/json" \
  -H "Accept: application/json, text/event-stream" \
  -d '{
    "jsonrpc": "2.0",
    "id": 1,
    "method": "initialize",
    "params": {
      "protocolVersion": "2025-06-18",
      "capabilities": {},
      "clientInfo": {
        "name": "cli-test",
        "version": "1.0.0"
      }
    }
  }'
```
