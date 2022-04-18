<?php

require 'model/conexion.php';
include('includes/header.php');

$conexion = conectarDB();


if(isset($_SESSION['user'])) {
    header('location: view/admin.php');
}

$errores = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $email = mysqli_real_escape_string($conexion, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($conexion, $_POST['password']);

    $query = "SELECT * FROM `users` WHERE correo = '${email}' AND password = '${password}'";

    $respuesta = mysqli_query($conexion, $query);


    

    if ($respuesta->num_rows) {

        $user = mysqli_fetch_assoc($respuesta);
        session_start();
        $_SESSION['user'] = $user['correo'];
        header('location: /view/admin.php');
    } else {

        if(!$password) {
            $errores[] = "La contraseña es incorrecta o no es valida<br>";
        }

        if(!$email) {
            $errores[] = "El correo es incorrecto o no es valido<br>";
        }
    }
}




?>

<?php foreach($errores as $error): ?>
        <div class="alerta error">
            
        <?php echo $error; ?>

        </div>

        <?php endforeach; ?>

        <div class="caja-formulario">

    <form method="POST" class="formulario">

        <h3>Iniciar sesión</h3>

        <label for="email">Correo</label>
        <input type="email" name="email" id="email" placeholder="Tu correo aqui">

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Tu contraseña aqui">

        <input type="submit" value="Ingresar">

    </form>

</div>


<main class="contenedor">



</main>







<?php

mysqli_close($conexion);
include('includes/footer.php');

?>


