<?php

header('Content-type: application/json; charset=utf-8');
http_response_code(403);
echo json_encode(["error" => "Access forbidden."]);

?>