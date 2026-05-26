<?php
require_once __DIR__ . '/bd/conexion.php';
require_once __DIR__ . '/bd/functions.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $libro = new Libro(
        $_POST['isbn'],
        $_POST['titulo'],
        $_POST['autor'],
        $_POST['editorial'],
        $_POST['genero_id']
    );
    actualizarlibro($libro);
    header('Location: index.php');
    exit;
}

$isbn = $_GET['isbn'] ?? '';
$libro = obtenerlibro($isbn);
if (!$libro) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar libro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'html/navbar.html' ?>
    <div class="container text-center my-5">
        <span class="material-symbols-outlined" style="font-size:2.5rem; color:#6750A4;">edit_note</span>
        <h1 class="mt-1">Editar libro</h1>
    </div>

    <div class="col-md-6 mx-auto my-5">
        <form class="form-libro" method="POST">
            <input type="hidden" name="isbn" value="<?php echo htmlspecialchars($libro->getIsbn()); ?>">
            <div class="mb-3">
                <label class="form-label">ISBN</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($libro->getIsbn()); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                    value="<?php echo htmlspecialchars($libro->getTitulo()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor"
                    value="<?php echo htmlspecialchars($libro->getAutor()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="editorial" class="form-label">Editorial</label>
                <input type="text" class="form-control" id="editorial" name="editorial"
                    value="<?php echo htmlspecialchars($libro->getEditorial()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <select class="form-select" id="genero" name="genero_id">
                    <?php
                    $generos = mysqli_query($conexion, "SELECT * FROM genero ORDER BY nombre");
                    while ($genero = mysqli_fetch_assoc($generos)) {
                        $selected = ($genero['id'] == $libro->getGeneroId()) ? "selected" : "";
                        echo "<option value='" . $genero['id'] . "' $selected>" . $genero['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="text-center my-5">
                <button type="submit" class="btn btn-success">
                    <span class="material-symbols-outlined">update</span>
                    Actualizar libro
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>