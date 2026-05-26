<?php


require_once __DIR__ . '/bd/conexion.php';
require_once __DIR__ . '/bd/functions.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['borrar']) && !empty($_GET['borrar'])) {
    $isbn = $_GET['borrar'];
    delete($isbn);
    header('Location: index.php');
    exit();
}

$genero_id = null;
if (isset($_GET['genero_id']) && is_numeric($_GET['genero_id'])) {
    $genero_id = intval($_GET['genero_id']);
}

$buscar = trim($_GET['buscar'] ?? '');

$listaLibros = obtenerLibros($genero_id, $buscar);
$i = 1;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de libro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'html/navbar.html'; ?>

    <div class="container text-center my-5">
        <h1>Listado de libros</h1>
        <?php if ($buscar !== ''): ?>
            <p style="color:#49454F;">Resultados para: <strong><?= htmlspecialchars($buscar) ?></strong>
                &nbsp;<a href="index.php" style="color:#B3261E; font-size:0.9rem;">✕ Limpiar búsqueda</a>
            </p>
        <?php endif; ?>
    </div>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Libro</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Género</th>
                    <th scope="col">Editorial</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaLibros)): ?>
                    <tr>
                        <td colspan="6" class="text-center">No hay libros registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($listaLibros as $libro): ?>
                        <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <td><?php echo htmlspecialchars($libro->getTitulo()); ?></td>
                            <td><?php echo htmlspecialchars($libro->getAutor()); ?></td>
                            <td><?php echo htmlspecialchars($libro->getNombreGenero()); ?></td>
                            <td><?php echo htmlspecialchars($libro->getEditorial()); ?></td>
                            <td>
                                <a href="editar.php?isbn=<?php echo urlencode($libro->getIsbn()); ?>"
                                    title="Editar" style="color:#6750A4; text-decoration:none;">
                                    <span class="material-symbols-outlined" style="font-size:1.3rem;">edit</span>
                                </a>

                                <a href="index.php?borrar=<?php echo urlencode($libro->getIsbn()); ?>"
                                    title="Eliminar" style="color:#B3261E; text-decoration:none; margin-left:8px;"
                                    onclick="return confirm('¿Seguro que quieres eliminar este libro?')">
                                    <span class="material-symbols-outlined" style="font-size:1.3rem;">delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="container text-center my-5">
            <a href="input.php" class="btn btn-success">
                <span class="material-symbols-outlined align-middle">add</span>
                Añadir nuevo libro
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>