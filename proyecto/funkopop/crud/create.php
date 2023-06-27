<?php
include_once "header.php";

//Comprueba si los campos fueron recibidos por el metodo POST 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("database.php");
    $productos = new Database();
//Valida la informacion para evitar injecciones de SQL 
    $nombre = $productos->sanitize($_POST['nombre']);
    $stock = $productos->sanitize($_POST['stock']);
    $precio = $productos->sanitize($_POST['precio']);
    $descripcion = $productos->sanitize($_POST['descripcion']);

    $img = generateUniqueFilename($_FILES['img']['name']);

    $uploadDir = "../img/";
    $uploadPath = $uploadDir . $img;

    if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadPath)) {

		//Valida que los campos al retirar los required no puedan ser enviados sin estar completos, se complementan con el sanitize
        if (empty($nombre) || empty($stock) || empty($precio) || empty($descripcion) || empty($img)) {
            $message = "Por favor, complete todos los campos.";
            $class = "alert alert-danger";
        } else {
			//Inserta la informacion a la BD utilizando el metodo create de databse.php
            $res = $productos->create($nombre, $stock, $precio, $descripcion, $img);
            if ($res) {
                $message = "Datos insertados con éxito";
                $class = "alert alert-success";
            } else {
                $message = "No se pudieron insertar los datos";
                $class = "alert alert-danger";
            }
        }
    } else {
        $message = "Error al cargar la imagen";
        $class = "alert alert-danger";
    }
}
//Metodo que genera un nombre unico a la fotos almacenadas en la BD
function generateUniqueFilename($filename) {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    $uniqueName = $basename . '_' . uniqid() . '.' . $extension;
    return $uniqueName;
}
//A partir de aca es unicamente el formulario de enviar datos para la creacion de los productos
?>

<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Agregar <b>Producto</b></h2></div>
                <div class="col-sm-4">
                    <a href="index.php" class="btn btn-info add-new fondonaranja"><i class="fa fa-arrow-left"></i> Regresar</a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <?php if (isset($message)): ?>
                <div class="<?php echo $class; ?>"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <form method="post" enctype="multipart/form-data" class="col-md-6">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" maxlength="100" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock:</label>
                    <input type="number" name="stock" id="stock" class="form-control" maxlength="100" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" maxlength="255" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio:</label>
                    <input type="number" name="precio" id="precio" class="form-control" maxlength="15" required>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">Imagen:</label>
                    <input type="file" name="img" id="img" class="form-control" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Agregar Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once "footer.php"; ?>
