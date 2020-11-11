<?php
require_once "Conexion.php";
class EstudioNivel extends Conexion
{

    private $tb_estudiosnivel_id;
    private $tb_estudiosnivel_des;
    private $con;

    public function __construct()
    {
        $this->con = new Conexion();
    }

    public function set($atributo, $contenido)
    {
        $this-> $atributo = $contenido;
    }

    public function get($atributo){
        return $this->$atributo;
    }


    public function mostrarDatos()
    {
        $sql = "SELECT * FROM tb_estudiosnivel;";
        $query = $this->con->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    
}
