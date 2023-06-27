<?php include_once "header.php"; ?>
<section class="vh-100 ">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card fondonaranja text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Ingresar</h2>
              <p class="text-white-50 mb-5">Porfavor ingresa email y contraseña</p>

              <div class="form-outline form-white mb-4">
                <input type="email" id="typeEmailX" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX" value="Email">Email</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX" value="Contraseña">Password</label>
              </div>

             

              <button class="btn btn-outline-light btn-lg px-5 fondoceleste" type="submit"><a href="crud/index.php" class="text-white-50 fw-bold">Ingresar</a></button>

              

            </div>

            <div>
              <p class="mb-0">No tienes cuenta? Resgistrate <a href="registrarse.php" class="text-white-50 fw-bold">Registrarse</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include_once "footer.php"; ?>