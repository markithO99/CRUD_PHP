<?php
require_once "../modelo/EstudioNivel.php";
$oEstudioNivelController = new EstudioNivelController();
switch ($_GET["op"]) {
    case 'Listar':
        echo $oEstudioNivelController->Listar();
        break;
}
class EstudioNivelController
{
    private $estudionivel;

    public function __construct()
    {
        $this->estudionivel = new EstudioNivel();
    }
    public function listar()
    {
        try {
            try {
?>
                <option value="0">-</option>
                <?php
                $dts = $this->estudionivel->mostrarDatos();

                foreach ($dts as $key => $dt) {
                ?>
                    <option value="<?php echo $dt['tb_estudiosnivel_id'] ?>" <?php if (isset($_POST['estudionivel_id'])) {
                                                                                    if ($dt['tb_estudiosnivel_id'] == $_POST['estudionivel_id']) {
                                                                                        echo 'selected ';
                                                                                    }
                                                                                }
                                                                                ?>>
                        <?php echo $dt['tb_estudiosnivel_des']; ?>
                    </option>
<?php
                }
            } catch (Exception $e) {
                echo json_encode(array('response' => 'Error,' . $e->getMessage()));
            }
        } catch (Exception $e) {
            echo json_encode(array('response' => 'Error,' . $e->getMessage()));
        }
    }
}
