
<!-- Modal -->
<div class="modal fade" id="insertarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="frminsert" onsubmit="return insertarDatos()" method="post">
              <label>Nombre</label>
              <input type="text" id="nombre" name="nombre" class="form-control form-control-sm" required="">
              <label>A. Paterno</label>
              <input type="text" id="apaterno" name="apaterno" class="form-control form-control-sm" required="">
              <label>A. Materno</label>
              <input type="text" id="amaterno" name="amaterno" class="form-control form-control-sm" required="">
              <label>Dni</label>
              <input type="text" id="dni" name="dni" class="form-control form-control-sm" required="">
              <label>Email</label>
              <input type="text" id="email" name="email" class="form-control form-control-sm" required="">
              <label>Genero</label>
              <select name="cmb_genero" id="cmb_genero"></select>
              <label>Estudio</label>
              <select name="cmb_estudio" id="cmb_estudio"></select>
              <br>
               <input type="submit" value="Guardar" class="btn btn-primary">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>


