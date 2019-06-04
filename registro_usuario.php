<?php session_start();
if (isset($_SESSION['usuario'])) {
	header('Location: formulario_personaje.html');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	$password2 = $_POST['vpassword'];
	$errores = '';
	if (empty($usuario) or empty($password) or empty($password2)) {
		$errores .= '<li>Por favor rellena todos los datos</li>';
	} else {
		try {
			$conexion = new PDO('mysql:host=localhost;dbname=gsp', 'root', '');
		} catch (PDOExeption $e) {
			echo "Error: " . $e->getMessage();
		}
		$statement = $conexion->prepare('SELECT * FROM usuarios WHERE nombre = :usuario LIMIT 1');
		$statement->execute(array(':usuario' => $usuario));
		$resultado = $statement->fetch();
		
		if ($resultado != false) {
			$errores .= '<li>El nombre de usuario ya existe</li>';
		}
		//HASS DE LA CONTRASEñA (encriptar)
		$password = hash('sha512', $password);
		$password2 = hash('sha512', $password2);
		if ($password != $password2) {
			$errores .= '<li>Las contraseñas no son iguales</li>';
		}
	}
	if ($errores == '') {
		$statement = $conexion->prepare('INSERT INTO usuarios (id, nombre, contrasena) VALUES (null, :usuario, :pass)');
		$statement->execute(array(':usuario' => $usuario, ':pass' => $password));
		header('Location: login.php');
	}
}
//require 'registro_usuario.php';
?>

<!DOCTYPE html>
<html lang="en" class="animated fadeInDown">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8/">
  <link rel="stylesheet" type="text/css" href="css/estilo_registro_usuario.css">
  <link rel="stylesheet" type="text/css" href="css/estilo_header.css">
  <link rel="stylesheet"  href="css/animate.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/header.js"></script>
    
	<title>Document</title>
	 
</head>
<body>
	<header>
         <div class="envol">
         <div class="logo"> Gestor de Personajes </div>         
          <nav>
          <!--a href="login.html">Inicia Sesión</a>
          <a href="registro_usuario.html">Regístrate</a-->
          <a href="formulario_personaje.html">Crea / Edita</a>
          <a href="Reporte.html">Reporta</a>
          </nav>
        </div>
        </header>
        <section class="contenido envol">
	<h1>Registro</h1>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login">
		Introduce un nombre de usuario válido <input type="text" class="redondo" name="usuario" placeholder="Usuario"><br>
		Introduce una contraseña <input type="password" class="redondo" name="password" placeholder="Contraseña"><br>
		Repite tu contraseña <input type="password" class="redondo" name="vpassword" placeholder="Confirma Contraseña"><br><br>
		<button class="boton" type="button" onclick="login.submit()">Registrar</button><br>
		<?php if(!empty($errores)): ?>
				<div>
					<ul>
						<?php echo $errores; ?>
					</ul>
				</div>
		<?php endif; ?>
	</form>
	 <form  name="subida-imagen" type="POST" enctype="multipart/formdata">
    <input type="file" name="imagen"/>
     <input type="submit" name="subir-imagen" value="Enviar Imagen"/>
  </form> 
	<p>
		<a href="login.php">Iniciar Sesión</a>
	</p>
</section>

</body>
</html>