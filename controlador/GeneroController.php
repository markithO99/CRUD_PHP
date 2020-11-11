<?php
require_once "../modelo/Genero.php";
$oGeneroController = new GeneroController();
switch ($_GET["op"]) {
    case 'Listar':
        echo $oGeneroController->Listar();
        break;
}

class GeneroController
{
    private $genero;

    public function __construct()
    {
        $this->genero = new Genero();
    }

    public function Listar()
    {
        try {
?>
            <option value="0">-</option>
            <?php
            $dts = $this->genero->mostrarDatos();

            foreach ($dts as $key => $dt) {
            ?>
                <option value="<?php echo $dt['tb_genero_id'] ?>" <?php if (isset($_POST['genero_id'])) {
                                                                        if ($dt['tb_genero_id'] == $_POST['genero_id']) {
                                                                            echo 'selected ';
                                                                        }
                                                                    }
                                                                    ?>>
                    <?php echo $dt['tb_genero_des']; ?>
                </option>
<?php
            }
        } catch (Exception $e) {
            echo 'Error,' . $e->getMessage();
        }
    }
}







