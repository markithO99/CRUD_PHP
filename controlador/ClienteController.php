<?php
require_once "../modelo/Cliente.php";

$oClienteController = new ClienteControlador();

switch ($_GET["op"]) {
    case 'Mostrar':
        echo $oClienteController->mostrar();
        break;
    case 'Grabar':
        echo $oClienteController->grabar();
        break;
    case 'ObtenerDatos':
        echo $oClienteController->ObtenerDatos();
        break;
    case 'ActualizarDatos':
        echo $oClienteController->ActualizarDatos();
        break;
    case 'Eliminar':
        echo $oClienteController->Eliminar();
        break;
}



class ClienteControlador
{
    private $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function mostrar()
    {
        try {

            $datos = $this->cliente->mostrarDatos();
            $tabla = '<table class="table table-dark">
            <thead>
                <tr class="font-weight-bold">
                    <td>ID</td>
                    <td>CLIENTES</td>
                    <td>DNI</td>
                    <td>GENERO</td>
                    <td>CORREO</td>
                    <td>ESTUDIOS</td>
                    <td>OPERACIONES</td>
                </tr>
            </thead>
            <tbody>';
            $datosTabla = "";
            foreach ($datos as $key => $value) {
                $datosTabla = $datosTabla . '<tr>
                <td>' . $value['tb_cliente_id'] . '</td>
                <td>' . $value['tb_cliente_nom'] . ' ' . $value['tb_cliente_apepa'] . ' ' . $value['tb_cliente_apema'] . '</td>
                <td>' . $value['tb_cliente_doc'] . '</td>
                <td>' . $value['genero'] . '</td>
                <td>' . $value['tb_cliente_email'] . '</td>
                <td>' . $value['estudio'] . '</td>
                <td>
                    <span class="btn btn-warning btn-sm" onclick="obtenerDatos(' . $value['tb_cliente_id'] . ')" data-toggle="modal" data-target="#actualizarModal">
                        <i class="fas fa-edit"></i>
                    </span>
                    <span class="btn btn-danger" onclick="eliminarDatos(' . $value['tb_cliente_id'] . ')">
                        <li class="fas fa-trash-alt"></li>
                    </span>
                </td>
            </tr>';
            }
            $aryRows = $tabla . $datosTabla . '</tbody>
</table>';
            echo json_encode(array('response' => '¡Carga de datos exitosamente!', 'data' => $aryRows));
        } catch (Exception $e) {
            echo json_encode(array('response' => 'Error,' . $e->getMessage()));
        }
    }


    public function grabar()
    {
        try {

            $sApaterno        = isset( $_POST['apaterno'] ) ? $_POST['apaterno'] : null;
            $sApaterno        = isset( $_POST['amaterno'] ) ? $_POST['amaterno'] : null;
            $sNombre          = isset( $_POST['nombre'] ) ? $_POST['nombre'] : null;
            $nDni             = isset( $_POST['dni'] ) ? $_POST['dni'] : null;
            $nCmb_genero_id   = isset( $_POST['cmb_genero'] ) ? $_POST['cmb_genero'] : null;
            $nCmb_estudio_id  = isset( $_POST['cmb_estudio'] ) ? $_POST['cmb_estudio'] : null;
            $sEmail           = isset( $_POST['email'] ) ? $_POST['email'] : null;


            $this->cliente->set("tb_cliente_apepa", trim($sApaterno));
            $this->cliente->set("tb_cliente_apema", trim($sApaterno));
            $this->cliente->set("tb_cliente_nom", trim($sNombre));
            $this->cliente->set("tb_cliente_doc", trim($nDni));
            $this->cliente->set("tb_genero_id", trim($nCmb_genero_id));
            $this->cliente->set("tb_estudiosnivel_id", trim($nCmb_estudio_id));
            $this->cliente->set("tb_cliente_email", trim($sEmail));

            $this->cliente->insertarDatos();

            return json_encode(array('response' => '¡Almacenado Correctamente!', 'data' => ""));;
        } catch (Exception $e) {
            return json_encode(array('response' => 'Error,' . $e->getMessage()));
        }
    }

    public function ObtenerDatos()
    {
        try {

            $nIdCliente       = isset( $_POST['id'] ) ? $_POST['id'] : null;

            if ( $nIdCliente == null ) {
                $error = 'Error. No ha especificado el identificador del cliente. Por favor verifique.';
                throw new Exception( json_encode( array( 'response' => $error ) ), 1 );
            }

            $this->cliente->set("tb_cliente_id", trim($nIdCliente));

            $objRow = $this->cliente->obtenerDatos();
            echo json_encode(array('response' => '¡Datos Cliente Cargado Correctamente!', 'data' => $objRow));
        } catch (Exception $e) {
            echo json_encode(array('response' => 'Error,' . $e->getMessage()));
        }
    }

    public function ActualizarDatos()
    {
        try {

            $nIdCliente       = isset( $_POST['id'] ) ? $_POST['id'] : null;
            $sApaterno        = isset( $_POST['apaternou'] ) ? $_POST['apaternou'] : null;
            $sApaterno        = isset( $_POST['amaternou'] ) ? $_POST['amaternou'] : null;
            $sNombre          = isset( $_POST['nombreu'] ) ? $_POST['nombreu'] : null;
            $nDni             = isset( $_POST['dniu'] ) ? $_POST['dniu'] : null;
            $nCmb_genero_id   = isset( $_POST['cmb_generou'] ) ? $_POST['cmb_generou'] : null;
            $nCmb_estudio_id  = isset( $_POST['cmb_estudiou'] ) ? $_POST['cmb_estudiou'] : null;
            $sEmail           = isset( $_POST['emailu'] ) ? $_POST['emailu'] : null;

            if ( $nIdCliente == null ) {
                $error = 'Error. No ha especificado el identificador del cliente. Por favor verifique.';
                throw new Exception( json_encode( array( 'response' => $error ) ), 1 );
            }

            $this->cliente->set("tb_cliente_id", trim($nIdCliente));
            $this->cliente->set("tb_cliente_apepa", trim($sApaterno));
            $this->cliente->set("tb_cliente_apema", trim($sApaterno));
            $this->cliente->set("tb_cliente_nom", trim($sNombre));
            $this->cliente->set("tb_cliente_doc", trim($nDni));
            $this->cliente->set("tb_genero_id", trim($nCmb_genero_id));
            $this->cliente->set("tb_estudiosnivel_id", trim($nCmb_estudio_id));
            $this->cliente->set("tb_cliente_email", trim($sEmail));

            $this->cliente->actualizarDatos();
            echo json_encode(array('response' => '!Actualizado Correctamente!', 'data' => ""));
        } catch (Exception $e) {
            echo json_encode(array('response' => 'Error,' . $e->getMessage()));
        }
    }

    public function Eliminar()
    {
        try {
            $nIdCliente       = isset( $_POST['id'] ) ? $_POST['id'] : null;

            if ( $nIdCliente == null ) {
                $error = 'Error. No ha especificado el identificador del cliente. Por favor verifique.';
                throw new Exception( json_encode( array( 'response' => $error ) ), 1 );
            }

            $this->cliente->set("tb_cliente_id", trim($nIdCliente));
            $this->cliente->eliminarDatos();
            echo json_encode(array('response' => '!Eliminado Correctamente!', 'data' => ""));
        } catch (Exception $e) {
            echo json_encode(array('response' => 'Error,' . $e->getMessage()));
        }
    }
}
