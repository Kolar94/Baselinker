#A simple PHP Class for use with a BaseLinker API


##example of use:

```
$api = new Baselinker\Baselinker($token);

$params = [
    "storage_id" => "bl_1"
];

$response = $api->getProductsList($params);
```