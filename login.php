<?php session_start();
if (isset($_SESSION['usuario'])) {
	header('Location: formulario_personaje.php');
}
$errores = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	$password = hash('sha512', $password);
	try {
		$conexion = new PDO('mysql:host=localhost;dbname=gsp', 'root', '');
	} catch (PDOException $e) {
		echo "Error:" . $e->getMessage();;
	}
	$statement = $conexion->prepare('
		SELECT * FROM usuarios WHERE nombre = :usuario AND contrasena = :password'
	);
	$statement->execute(array(
		':usuario' => $usuario, 
		':password' => $password
	));
	$resultado = $statement->fetch();
	if ($resultado !== false) {
		$_SESSION['usuario'] = $usuario;
		$_SESSION['id'] = $resultado['id'];
		header('Location: formulario_personaje.php');
	} else {
		$errores .= '<li>Datos Incorrectos</li>';
	}
}
//require 'views/login.view.php';
?>
<!DOCTYPE html>
<html lang="en" class="animated fadeInLeft">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/estilo_header.css">
	<link rel="stylesheet"  href="css/estilo_login.css">
	 <link rel="stylesheet"  href="css/animate.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/header.js"></script>
  	
  	
</head>

<body>
	 <header>
         <div class="envol">
         <div class="logo"> Gestor de Personajes </div>         
          <nav>
          <!--a href="login.php">Inicia Sesión</a>
          <a href="registro_usuario.php">Regístrate</a-->
          <a href="formulario_personaje.php">Crea</a>
          <a href="Reporte.php">Reporta</a>
          </nav>
        </div>
     </header>
        <section class="contenido envol">
	<!--h1>Iniciar Sesión</h1-->
	<div class="contenedor">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login">
		<input type="text" class= "redondo" name="usuario" placeholder="Usuario"><br>
		<input type="password" class= "redondo" name="password" placeholder="Contrasena"><br>
		<button type="button" onclick="login.submit()">Iniciar Sesion</button><br>
		<?php if(!empty($errores)): ?>
				<div>
					<ul>
						<?php echo $errores; ?>
					</ul>
				</div>
		<?php endif; ?>
	</form>
	</div>
	<p>
		<a href="registro_usuario.php">Registrate</a><br>
	</p>

</section>
</body>
</html>