<?php


require 'Conectar.php';

class Metodo
{


    private $lat      = 0;
    private $lng      = 0;
    private $conexion;

    public function __construct()
    {
        $con = new Conectar();
        $this->conexion = $con->conexion();
    }

    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    public function get_coordenadas()
    {
        $coordenadas = [
            'lat' => $this->lat,
            'lng' => $this->lng
        ];

        echo json_encode($coordenadas);
    }

    public function get_poligono()
    {
        $stmt = $this->conexion->prepare("SELECT * FROM poli ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
