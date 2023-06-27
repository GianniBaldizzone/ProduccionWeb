<?php include_once "header.php"; ?>
<div class="">
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Listado de <b>Productos</b></h2>
                    </div>
                    <div class="col-sm-4 text-center">
                        <a href="create.php" class="btn btn-info add-new fondonaranja"><i class="fa fa-plus"></i> Agregar Producto</a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <?php
                include('database.php');
                $productos = new Database();

                // Configuración de paginación
                $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Página actual
                $itemsPerPage = 10; // Número de productos por página
                $start = ($page - 1) * $itemsPerPage; // Índice de inicio para la consulta

                $listado = $productos->readLimited($start, $itemsPerPage);
                ?>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_object($listado)) {
                        $id = $row->id;
                        $nombre = $row->nombre;
                        $stock = $row->stock;
                        $precio = $row->precio;
                        $descripcion = $row->descripcion;
                        $img = $row->img;
                    ?>
                        <tr>
                            <td><?php echo $nombre; ?></td>
                            <td><?php echo $stock; ?></td>
                            <td><?php echo $precio; ?>$</td>
                            <td><?php echo $descripcion; ?></td>
                            <td><?php echo $img; ?></td>
                            <td class="text-center">
                                <a href="update.php?id=<?php echo $id; ?>" class="btn btn-primary" title="Editar" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                <a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger" title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
            // Calcula el número de páginas
            $totalProducts = mysqli_num_rows($productos->read());
            $totalPages = ceil($totalProducts / $itemsPerPage);
            ?>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo ($page - 1); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item<?php echo ($page == $i) ? ' active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo ($page + 1); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php include_once "footer.php"; ?>
