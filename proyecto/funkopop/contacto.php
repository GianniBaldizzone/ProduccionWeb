<?php include_once "header.php"; ?>
<section id="contactoSection">
  <div class="container">
    <h2 class="text-center mb-5">Contacto</h2>
    <form action="https://formsubmit.co/gianni.baldizzone@davinci.edu.ar" method="POST" onsubmit="showSuccessMessage()">
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="fullName">Nombre</label>
            <input class="form-control" type="text" name="fullName" id="fullName" required />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" required />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="message">Mensaje</label>
            <textarea class="form-control" name="message" id="message" rows="5"></textarea>
          </div>
        </div>
      </div>
      <input type="hidden" name="formSubmitted" value="true" />
      <div class="row">
        <div class="col-12">
          <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
      </div>
      <input type="hidden" name="_captcha" value="false" />
      <input type="text" name="_honey" style="display: none" />
    </form>
  </div>
</section>

<script>
  function showSuccessMessage() {
    alert("El formulario se ha enviado correctamente. ¡Gracias!");
  }
</script>
<?php include_once "footer.php"; ?>