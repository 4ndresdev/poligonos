<?php

require 'Metodo.php';

$metodos = new Metodo();

echo json_encode($metodos->get_poligono());
header('Content-type: application/json');
http_response_code(200);
