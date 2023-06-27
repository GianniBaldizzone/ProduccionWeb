<?php
//se verifica si se ha proporcionado un parámetro id a través de la URL usando $_GET['id']. Si existe, se convierte a un entero utilizando intval() y se asigna a la variable $id. De lo contrario, se redirige al usuario a index.php utilizando header("location:index.php").

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    header("location:index.php");
}
?>
<?php include_once "header.php"; ?>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Editar <b>Producto</b></h2></div>
                <div class="col-sm-4">
                    <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                </div>
            </div>
        </div>
        <?php
        include("database.php");
        $productos = new Database();
		//Validacion: se verifica si se ha enviado un formulario mediante isset($_POST) && !empty($_POST). Si es verdadero, significa que se ha enviado el formulario y se procede a actualizar los datos del producto.
        //Al verificar si se ha enviado el formulario , a cada campo se lo guarda en una variable y se le aplica el metodo sanitize que es un metodo php que es para intentar evitar injecciones de SQL.
        if (isset($_POST) && !empty($_POST)) {
            $nombre = $productos->sanitize($_POST['nombre']);
            $stock = $productos->sanitize($_POST['stock']);
            $precio = $productos->sanitize($_POST['precio']);
            $descripcion = $productos->sanitize($_POST['descripcion']);
            $id_producto = intval($_POST['id_producto']);

            // Verificar si se ha subido una nueva imagen
            if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $img = $_FILES['img']['name'];
                $img_tmp = $_FILES['img']['tmp_name'];

                // Mover la nueva imagen a la carpeta de destino
                $img_destino = "../img/" . $img;
                move_uploaded_file($img_tmp, $img_destino);
            } else {
                // No se subió una nueva imagen, mantener la imagen existente
                $img = $productos->sanitize($_POST['img']);
            }
            
			//Aca se realiza la modificacion de la informacion
            $res = $productos->update($nombre, $stock, $precio, $descripcion, $img, $id_producto);
            if ($res) {
                $message = "Datos actualizados con éxito";
                $class = "alert alert-success";
            } else {
                $message = "No se pudieron actualizar los datos";
                $class = "alert alert-danger";
            }
        ?>
            <div class="<?php echo $class ?>">
                <?php echo $message; ?>
            </div>
        <?php
        }
		//De esta formulario provienen la informacion que vamos a modificar el la BD
		//Single_record hace una consulta para traer la informacion completa de un producto por id
        $datos_productos = $productos->single_record($id);
        ?>
        <div class="row">
            <form method="post" enctype="multipart/form-data">
                <div class="col-md-6">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class='form-control' maxlength="100" required value="<?php echo $datos_productos->nombre; ?>">
                    <input type="hidden" name="id_producto" id="id_producto" class='form-control' maxlength="100" value="<?php echo $datos_productos->id; ?>">
                </div>
                <div class="col-md-6">
                    <label>Stock:</label>
                    <input type="number" name="stock" id="stock" class='form-control' maxlength="100" required value="<?php echo $datos_productos->stock; ?>">
                </div>
                <div class="col-md-12">
                    <label>Descripcion:</label>
                    <textarea name="descripcion" id="descripcion" class='form-control' maxlength="255" required><?php echo $datos_productos->descripcion; ?></textarea>
                </div>
                <div class="col-md-6">
                    <label>Precio:</label>
                    <input type="number" name="precio" id="precio" class='form-control' maxlength="15" required value="<?php echo $datos_productos->precio; ?>">
                </div>
                <div class="col-md-6">
                    <label>Imagen:</label>
                    <input type="file" class="form-control" id="img" name="img" accept="image/*">
                    <input type="hidden" name="img" value="<?php echo $datos_productos->img; ?>">
                </div>

                <div class="col-md-12 pull-right">
                    <hr>
                    <button type="submit" class="btn btn-success">Actualizar datos</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once "footer.php"; ?>
