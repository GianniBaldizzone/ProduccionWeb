<?php
if (isset($_GET['id'])) {
    include('database.php');
    $producto = new Database();
    $id = intval($_GET['id']);
    $product = $producto->single_record($id); // Obtener los datos del producto
    $imagePath = '../img/' . $product->img; // Ruta de la imagen del producto

    // Eliminar la imagen del producto
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Eliminar el registro de la base de datos
    $res = $producto->delete($id);
    if ($res) {
        header('location: index.php');
    } else {
        echo "Error al eliminar el registro";
    }
}
?>
