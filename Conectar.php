<?php


class Conectar
{

  private $servername = "localhost";
  private $username   = "root";
  private $password   = "";

  public function conexion()
  {

    try {
      $conexion = new PDO("mysql:host=$this->servername;dbname=poligonos", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conexion;
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }
}
