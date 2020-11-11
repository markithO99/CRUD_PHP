<?php
require_once "Conexion.php";
class Cliente extends Conexion
{
    private $tb_cliente_id;
    private $tb_cliente_xac;
    private $tb_cliente_apepa;
    private $tb_cliente_apema;
    private $tb_cliente_nom;
    private $tb_cliente_doc;
    private $tb_genero_id;
    private $tb_estudiosnivel_id;
    private $tb_cliente_email;

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
        $sql ="SELECT *,g.tb_genero_des as genero,en.tb_estudiosnivel_des as estudio FROM tb_cliente c
        JOIN tb_genero g ON c.tb_genero_id  = g.tb_genero_id 
        JOIN tb_estudiosnivel en ON c.tb_estudiosnivel_id  = en.tb_estudiosnivel_id
        WHERE tb_cliente_xac=1 ;";
        $query = $this->con->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function insertarDatos()
    {
        $sql = "INSERT INTO tb_cliente(tb_cliente_apepa,tb_cliente_apema,tb_cliente_nom,tb_cliente_doc,tb_genero_id ,tb_estudiosnivel_id ,tb_cliente_email)
                VALUES (:tb_cliente_apepa,:tb_cliente_apema,:tb_cliente_nom,:tb_cliente_doc,:tb_genero_id ,:tb_estudiosnivel_id ,:tb_cliente_email)";
        $query = $this->con->prepare($sql);

        $query->bindParam(':tb_cliente_apepa', $this->tb_cliente_apepa, PDO::PARAM_STR);
        $query->bindParam(':tb_cliente_apema', $this->tb_cliente_apema, PDO::PARAM_STR);
        $query->bindParam(':tb_cliente_nom', $this->tb_cliente_nom, PDO::PARAM_STR);
        $query->bindParam(':tb_cliente_doc', $this->tb_cliente_doc, PDO::PARAM_STR);
        $query->bindParam(':tb_genero_id', $this->tb_genero_id, PDO::PARAM_INT);
        $query->bindParam(':tb_estudiosnivel_id', $this->tb_estudiosnivel_id, PDO::PARAM_INT);
        $query->bindParam(':tb_cliente_email', $this->tb_cliente_email, PDO::PARAM_STR);
        return $query->execute();
    }

    public function obtenerDatos()
    {
        $sql = "SELECT *,g.tb_genero_des as genero,en.tb_estudiosnivel_des as estudio FROM tb_cliente c
        JOIN tb_genero g ON c.tb_genero_id  = g.tb_genero_id 
        JOIN tb_estudiosnivel en ON c.tb_estudiosnivel_id  = en.tb_estudiosnivel_id 
        WHERE tb_cliente_id=:id";
        $query = $this->con->prepare($sql);
        $query->bindParam(':id', $this->tb_cliente_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch();
    }

    public function actualizarDatos()
    {
        $sql = "UPDATE tb_cliente
                SET
                tb_cliente_apepa= :tb_cliente_apepa,
                tb_cliente_apema= :tb_cliente_apema,
                tb_cliente_nom	= :tb_cliente_nom,
                tb_cliente_doc= :tb_cliente_doc,
                tb_genero_id = :tb_genero_id ,
                tb_estudiosnivel_id = :tb_estudiosnivel_id ,
                tb_cliente_email= :tb_cliente_email
                WHERE tb_cliente_id = :tb_cliente_id";

        $query = $this->con->prepare($sql);
        $query->bindParam(':tb_cliente_id', $this->tb_cliente_id, PDO::PARAM_INT);
        $query->bindParam(':tb_cliente_apepa', $this->tb_cliente_apepa, PDO::PARAM_STR);
        $query->bindParam(':tb_cliente_apema', $this->tb_cliente_apema, PDO::PARAM_STR);
        $query->bindParam(':tb_cliente_nom', $this->tb_cliente_nom, PDO::PARAM_STR);
        $query->bindParam(':tb_cliente_doc', $this->tb_cliente_doc, PDO::PARAM_STR);
        $query->bindParam(':tb_genero_id', $this->tb_genero_id, PDO::PARAM_INT);
        $query->bindParam(':tb_estudiosnivel_id', $this->tb_estudiosnivel_id, PDO::PARAM_INT);
        $query->bindParam(':tb_cliente_email', $this->tb_cliente_email, PDO::PARAM_STR);
        $query->bindParam(':tb_cliente_id', $this->tb_cliente_id, PDO::PARAM_INT);
        return $query->execute();
    }

    public function eliminarDatos()
    {
        $sql = "UPDATE tb_cliente
                SET tb_cliente_xac = 0
                WHERE tb_cliente_id= :tb_cliente_id";
        $query = $this->con->prepare($sql);
        $query->bindParam(':tb_cliente_id', $this->tb_cliente_id, PDO::PARAM_INT);
        return $query->execute();
    }
}
