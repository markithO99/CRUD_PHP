function cmb_genero_idU(id) {
    $.ajax({
        type: "POST",
        url: "../controlador/GeneroController.php?op=Listar",
        async: true,
        dataType: "html",
        data: ({
            genero_id: id
        }),
        beforeSend: function() {
            $('#cmb_generou').html('<option value="">Cargando...</option>');
        },
        success: function(html) {
            $('#cmb_generou').html(html);
        }
    });
}

function cmb_genero_id(id) {
    $.ajax({
        type: "POST",
        url: "../controlador/GeneroController.php?op=Listar",
        async: true,
        dataType: "html",
        data: ({
            genero_id: id
        }),
        beforeSend: function() {
            $('#cmb_genero').html('<option value="">Cargando...</option>');
        },
        success: function(html) {
            $('#cmb_genero').html(html);
        }
    });
}

function cmb_estudionivel_idU(id) {

    $.ajax({
        type: "POST",
        url: "../controlador/EstudioNivelController.php?op=Listar",
        async: true,
        dataType: "html",
        data: ({
            estudionivel_id: id
        }),
        beforeSend: function() {
            $('#cmb_estudiou').html('<option value="">Cargando...</option>');
        },
        success: function(html) {
            $('#cmb_estudiou').html(html);
        }
    });
}

function cmb_estudionivel_id(id) {

    $.ajax({
        type: "POST",
        url: "../controlador/EstudioNivelController.php?op=Listar",
        async: true,
        dataType: "html",
        data: ({
            estudionivel_id: id
        }),
        beforeSend: function() {
            $('#cmb_estudio').html('<option value="">Cargando...</option>');
        },
        success: function(html) {
            $('#cmb_estudio').html(html);
        }
    });
}

function mostrar() {
    $.ajax({
        type: "POST",
        url: "../controlador/ClienteController.php?op=Mostrar",
        dataType: 'json',
        success: function(r) {
            if (r.response.substr(0, 5) == 'Error') {
                swal(r.response, "Hubo un problema en la carga de datos, recarge la pagina o intente en unos minutos.", "error");
            } else {
                $('#tablaDatos').html(r.data);
            }
        }
    });
}

function obtenerDatos(id) {

    $.ajax({
        type: "POST",
        data: "id=" + id,
        url: "../controlador/ClienteController.php?op=ObtenerDatos",
        dataType: 'json',
        success: function(r) {

            if (r.response.substr(0, 5) == 'Error') {
                swal(r.response, "Hubo un problema en la carga de datos, recarge la pagina o intente en unos minutos.", "error");
            } else {
                $('#id').val(r.data['tb_cliente_id']);
                $('#nombreu').val(r.data['tb_cliente_nom']);
                $('#apaternou').val(r.data['tb_cliente_apepa']);
                $('#amaternou').val(r.data['tb_cliente_apema']);
                $('#dniu').val(r.data['tb_cliente_doc']);
                /* $('#cmb_genero').val(r['idgenero']);
                $('#cmb_estudio').val(r['idestudionivel']); */
                $('#emailu').val(r.data['tb_cliente_email']);
                cmb_genero_idU(r.data['tb_genero_id']);
                cmb_estudionivel_idU(r.data['tb_estudiosnivel_id']);
                console.log(r.response);
            }
        },
        complete: function() {

        }




    });

}

function actualizarDatos() {


    var expresion_correo = /\w+@\w+\.+[a-z]/;
    var expresion_numero = /^[-]?[0-9]+[\.]?[0-9]+$/;


    if ($('#nombreu').val().trim() == '') {
        swal("Campo Obligatorio", "El campo nombre no debe ir vacio.");
        return false;
    } else if ($('#apaternou').val().trim() == '') {
        swal("Campo Obligatorio", "El campo apellido paterno no debe ir vacio.");
        return false;
    } else if ($('#amaternou').val().trim() == '') {
        swal("Campo Obligatorio", "El campo apellido materno no debe ir vacio.");
        return false;
    } else if ($('#dniu').val().trim() == '') {
        swal("Campo Obligatorio", "El campo DNI no debe ir vacio.");
        return false;
    } else if ($('#emailu').val().trim() == '') {
        swal("Campo Obligatorio", "El campo email no debe ir vacio.");
        return false;
    } else if (!expresion_correo.test($('#emailu').val().trim())) {
        swal("Validación Formato", "El campo email no tiene el formato correcto.");
        return false;
    } else if ($('#cmb_generou').val().trim() == 0) {
        swal("Campo Obligatorio", "El campo genero no debe ir vacio.");
        return false;
    } else if ($('#cmb_estudiou').val().trim() == 0) {
        swal("Campo Obligatorio", "El campo estudio no debe ir vacio.");
        return false;
    } else if ($('#nombreu').val().trim().length > 100) {
        swal("Campo Obligatorio", "El campo nombre no debe exceder los 100 caracteres.");
        return false;
    } else if ($('#apaternou').val().trim().length > 100) {
        swal("Maximo Caracteres", "El campo apellido paterno no debe exceder los 100 caracteres.");
        return false;
    } else if ($('#amaternou').val().trim().length > 100) {
        swal("Maximo Caracteres", "El campo apellido materno no debe exceder los 100 caracteres.");
        return false;
    } else if ($('#dniu').val().trim().length != 8) {
        swal("Validación de Caracteres", "El campo DNI debe tener 8 caracteres.");
        return false;
    } else if (!expresion_numero.test($('#dniu').val().trim())) {
        swal("Validación Formato", "El campo DNI tiene que contener solo números.");
        return false;
    } else if ($('#emailu').val().trim().length > 100) {
        swal("Maximo Caracteres", "El campo apellido email no debe exceder los 100 caracteres.");
        return false;
    }

    $.ajax({
        type: "POST",
        url: "../controlador/ClienteController.php?op=ActualizarDatos",
        data: $('#frminsertu').serialize(),
        dataType: 'json',
        success: function(r) {

            if (r.response.substr(0, 5) == 'Error') {
                swal(r.response, "Hubo un problema al actualizar, recarge la pagina o intentelo en unos minutos.", "error");
            } else {
                swal(r.response, "ok", "success");
            }
            mostrar();
        }
    });

    return false;
}


function eliminarDatos(id) {
    swal({
            title: "¿Estas seguro de eliminar este registro?",
            text: "!Una vez eliminado no podra recuperarse¡",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "../controlador/ClienteController.php?op=Eliminar",
                    data: "id=" + id,
                    dataType: 'json',
                    success: function(r) {
                        if (r.response.substr(0, 5) == 'Error') {
                            swal(r.response, "Hubo un problema al eliminar, recarge la pagina o intentelo en unos minutos.", "error");
                        } else {
                            mostrar();
                            swal(r.response, "ok", "info");
                        }
                    }
                });
            }
        });
}


function insertarDatos() {

    var expresion_correo = /\w+@\w+\.+[a-z]/;
    var expresion_numero = /^[-]?[0-9]+[\.]?[0-9]+$/;


    if ($('#nombre').val().trim() == '') {
        swal("Campo Obligatorio", "El campo nombre no debe ir vacio.");
        return false;
    } else if ($('#apaterno').val().trim() == '') {
        swal("Campo Obligatorio", "El campo apellido paterno no debe ir vacio.");
        return false;
    } else if ($('#amaterno').val().trim() == '') {
        swal("Campo Obligatorio", "El campo apellido materno no debe ir vacio.");
        return false;
    } else if ($('#dni').val().trim() == '') {
        swal("Campo Obligatorio", "El campo DNI no debe ir vacio.");
        return false;
    } else if ($('#email').val().trim() == '') {
        swal("Campo Obligatorio", "El campo email no debe ir vacio.");
        return false;
    } else if (!expresion_correo.test($('#email').val().trim())) {
        swal("Validación Formato", "El campo email no tiene el formato correcto.");
        return false;
    } else if ($('#cmb_genero').val().trim() == 0) {
        swal("Campo Obligatorio", "El campo genero no debe ir vacio.");
        return false;
    } else if ($('#cmb_estudio').val().trim() == 0) {
        swal("Campo Obligatorio", "El campo estudio no debe ir vacio.");
        return false;
    } else if ($('#nombre').val().trim().length > 100) {
        swal("Campo Obligatorio", "El campo nombre no debe exceder los 100 caracteres.");
        return false;
    } else if ($('#apaterno').val().trim().length > 100) {
        swal("Maximo Caracteres", "El campo apellido paterno no debe exceder los 100 caracteres.");
        return false;
    } else if ($('#amaterno').val().trim().length > 100) {
        swal("Maximo Caracteres", "El campo apellido materno no debe exceder los 100 caracteres.");
        return false;
    } else if ($('#dni').val().trim().length != 8) {
        swal("Validación de Caracteres", "El campo DNI debe tener 8 caracteres.");
        return false;
    } else if (!expresion_numero.test($('#dni').val().trim())) {
        swal("Validación Formato", "El campo DNI tiene que contener solo números.");
        return false;
    } else if ($('#email').val().trim().length > 100) {
        swal("Maximo Caracteres", "El campo apellido email no debe exceder los 100 caracteres.");
        return false;
    }


    $.ajax({
        type: "POST",
        url: "../controlador/ClienteController.php?op=Grabar",
        data: $('#frminsert').serialize(),
        dataType: 'json',
        success: function(r) {
            if (r.response.substr(0, 5) == 'Error') {
                swal(r.response, "Hubo un problema al guardar, recarge la pagina o intentelo en unos minutos.", "error");
            } else {
                $('#frminsert')[0].reset();
                mostrar();
                swal(r.response, "ok", "success");
                $('#tablaDatos').html(r.data);
            }
        }
    });
    return false;
}