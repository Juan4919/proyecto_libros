<?php
require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/../clases/Libro.php';
require_once __DIR__ . '/../clases/Usuario.php';

function login($email, $password)
{
    global $conexion;

    $email_escapado = mysqli_real_escape_string($conexion, $email);
    $resultado = mysqli_query($conexion, "SELECT * FROM usuario WHERE email = '$email_escapado'");
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila && password_verify($password, $fila['password'])) {
        $usuario = new Usuario($fila['email'], $fila['password'], $fila['id']);
        session_start();
        $_SESSION['usuario'] = $usuario->getEmail();
        return ['success' => true, 'error' => ''];
    }
    return ['success' => false, 'error' => 'Correo o contraseña incorrectos'];
}

function registrar($email, $password)
{
    global $conexion;

    $email_escapado = mysqli_real_escape_string($conexion, $email);
    $consulta = mysqli_query($conexion, "SELECT id FROM usuario WHERE email = '$email_escapado'");

    if (mysqli_num_rows($consulta) > 0) {
        return ['success' => false, 'error' => 'Este correo ya está registrado.'];
    }

    $hash = password_hash($password, PASSWORD_BCRYPT);
    $usuario = new Usuario($email, $hash);

    $email_bd = mysqli_real_escape_string($conexion, $usuario->getEmail());
    $pass_bd = mysqli_real_escape_string($conexion, $usuario->getPassword());

    $ok = mysqli_query($conexion, "INSERT INTO usuario (email, password) VALUES ('$email_bd', '$pass_bd')");

    if ($ok) {
        return ['success' => true, 'error' => ''];
    }
    return ['success' => false, 'error' => 'Error al guardar el usuario: ' . mysqli_error($conexion)];
}

function procesarRegistro()
{
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';

        if (empty($email) || empty($password) || empty($password2)) {
            return 'Todos los campos son obligatorios.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'El correo electrónico no es válido.';
        }
        if ($password !== $password2) {
            return 'Las contraseñas no coinciden.';
        }
        if (strlen($password) < 6) {
            return 'La contraseña debe tener al menos 6 caracteres.';
        }

        $resultado = registrar($email, $password);

        if ($resultado['success']) {
            header('Location: login.php?registrado=1');
            exit;
        }
        $error = $resultado['error'];
    }
    return $error;
}

function procesarLogin()
{
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $resultado = login($email, $password);

        if ($resultado['success']) {
            header('location: index.php');
            exit;
        }
        $error = $resultado['error'];
    }
    return $error;
}

function buscar($termino)
{
    global $conexion;
    $t = mysqli_real_escape_string($conexion, $termino);
    $sql = "SELECT libro.*, genero.nombre AS nombre_genero
            FROM libro JOIN genero ON libro.genero_id = genero.id
            WHERE libro.titulo LIKE '%$t%'
               OR libro.autor LIKE '%$t%'
               OR libro.editorial LIKE '%$t%'";
    return mysqli_query($conexion, $sql);
}

function insertar($libro)
{
    global $conexion;
    $isbn = mysqli_real_escape_string($conexion, $libro->getIsbn());
    $titulo = mysqli_real_escape_string($conexion, $libro->getTitulo());
    $autor = mysqli_real_escape_string($conexion, $libro->getAutor());
    $editorial = mysqli_real_escape_string($conexion, $libro->getEditorial());
    $genero_id = intval($libro->getGeneroId());

    $sql = "INSERT INTO libro (isbn, titulo, autor, editorial, genero_id)
            VALUES ('$isbn', '$titulo', '$autor', '$editorial', $genero_id)";

    return mysqli_query($conexion, $sql);
};

function delete($isbn)
{
    global $conexion;

    $isbn_escapado = mysqli_real_escape_string($conexion, $isbn);

    $sql = "DELETE FROM libro WHERE isbn = '$isbn_escapado'";
    mysqli_query($conexion, $sql);
}

function obtenerlibro($isbn)
{
    global $conexion;
    $isbn_escapado = mysqli_real_escape_string($conexion, $isbn);
    $sql = "SELECT * FROM libro WHERE isbn = '$isbn_escapado'";
    $resultado = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    if (!$fila) {
        return null;
    }

    return new Libro(
        $fila['isbn'],
        $fila['titulo'],
        $fila['autor'],
        $fila['editorial'],
        $fila['genero_id']
    );
}

function obtenerLibros($genero_id, $buscar = '')
{
    global $conexion;
    $libros = [];

    $sql = "SELECT libro.*, genero.nombre AS nombre_genero
            FROM libro
            JOIN genero ON libro.genero_id = genero.id";

    $condiciones = [];
    if ($genero_id !== null) {
        $condiciones[] = "libro.genero_id = " . intval($genero_id);
    }
    if ($buscar !== '') {
        $t = mysqli_real_escape_string($conexion, $buscar);
        $condiciones[] = "(libro.titulo LIKE '%$t%' OR libro.autor LIKE '%$t%' OR libro.editorial LIKE '%$t%')";
    }
    if (!empty($condiciones)) {
        $sql .= " WHERE " . implode(' AND ', $condiciones);
    }

    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $libros[] = new Libro(
                $fila['isbn'],
                $fila['titulo'],
                $fila['autor'],
                $fila['editorial'],
                $fila['genero_id'],
                $fila['nombre_genero']
            );
        }
    }

    return $libros;
}

function actualizarlibro($libro)
{
    global $conexion;
    $isbn_escapado = mysqli_real_escape_string($conexion, $libro->getIsbn());
    $titulo_escapado = mysqli_real_escape_string($conexion, $libro->getTitulo());
    $autor_escapado = mysqli_real_escape_string($conexion, $libro->getAutor());
    $editorial_escapado = mysqli_real_escape_string($conexion, $libro->getEditorial());
    $genero_id = intval($libro->getGeneroId());

    $sql = "UPDATE libro SET
            titulo= '$titulo_escapado',
            autor = '$autor_escapado',
            editorial = '$editorial_escapado',
            genero_id = $genero_id
            WHERE isbn = '$isbn_escapado'";

    return mysqli_query($conexion, $sql);
}
