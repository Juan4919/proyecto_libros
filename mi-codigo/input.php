<?php
require_once __DIR__ . '/bd/conexion.php';
require_once __DIR__ . '/bd/functions.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$isbn = '';
$titulo = '';
$autor = '';
$editorial = '';
$genero_id = '';
$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isbn = trim($_POST['isbn']);
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $editorial = trim($_POST['editorial']);
    $genero_id = $_POST['genero_id'];

    if (empty($isbn)) {
        $errores['isbn'] = 'El ISBN es obligatorio.';
    } else {
        $isbn_escapado = mysqli_real_escape_string($conexion, $isbn);
        $consulta = mysqli_query($conexion, "SELECT isbn FROM libro WHERE isbn = '$isbn_escapado'");
        if (mysqli_num_rows($consulta) > 0) {
            $errores['isbn'] = 'Este ISBN ya está registrado.';
        }
    }
    if (empty($titulo)) {
        $errores['titulo'] = 'El título es obligatorio.';
    }
    if (empty($autor)) {
        $errores['autor'] = 'El autor es obligatorio.';
    }
    if (empty($editorial)) {
        $errores['editorial'] = 'La editorial es obligatoria.';
    }
    if (empty($genero_id)) {
        $errores['genero_id'] = 'Debes seleccionar un género.';
    }

    if (empty($errores)) {
        $libro = new Libro($isbn, $titulo, $autor, $editorial, $genero_id);
        if (insertar($libro)) {
            header('Location: index.php');
            exit();
        } else {
            $errores['general'] = 'Error al guardar: ' . mysqli_error($conexion);
        }
    }
};


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo libro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'html/navbar.html' ?>
    <div class="container text-center my-5">
        <span class="material-symbols-outlined" style="font-size:2.5rem; color:#6750A4;">library_add</span>
        <h1 class="mt-1">Nuevo libro</h1>
    </div>

    <div class="col-md-6 mx-auto my-5">
        <?php if (!empty($errores)): ?>
            <div class="alert alert-danger" role="alert">
                <?php
                foreach ($errores as $e) {
                    echo $e;
                }

                ?></div>
        <?php endif; ?>
        <form class="form-libro" method="POST">
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" title="El ISBN debe constar de 13 números (ejemplo 000-00-000-0000-0)">
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" required>
            </div>
            <div class="mb-3">
                <label for="editorial" class="form-label">Editorial</label>
                <input type="text" class="form-control" id="editorial" name="editorial" required>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <select class="form-select" id="genero" name="genero_id">
                    <option value="">-- Selecciona un género --</option>
                    <?php
                    $generos = mysqli_query($conexion, "SELECT * FROM genero ORDER BY nombre");
                    while ($genero = mysqli_fetch_assoc($generos)) {
                        echo "<option value='" . $genero['id'] . "'>" . $genero['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="text-center my-5">
                <button type="submit" class="btn btn-success">
                    <span class="material-symbols-outlined">save</span>
                    Guardar libro
                </button>
            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>