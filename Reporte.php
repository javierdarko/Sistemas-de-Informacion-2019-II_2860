<!DOCTYPE html>
<html lang="en"  class="animated fadeInUp" >
<head>
  <title>Reportar</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8/">
   <link rel="stylesheet" type="text/css" href="css/estilo_reporte.css">
    <link rel="stylesheet" type="text/css" href="css/estilo_header.css">
         <link rel="stylesheet"  href="css/animate.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/header.js"></script>


</head>

<body>

  <header>
      
         <div class="envol">
         <div class="logo"> Gestor de Personajes </div>         
          <nav>
          <a href="login.php">Inicia Sesión</a>
          <a href="registro_usuario.php">Regístrate</a>
          <a href="formulario_personaje.php">Crea / Edita</a>
          <a href="Reporte.php">Reporta</a>  

          </nav>
        </div>

        </header>
        <section class="contenido envol">


<h1>Llena los datos para completar tu reporte</h1>
<form action="/action_page.php">

  <m>¿Que quieres reportar?</m><br>
  <input type="radio" name="rep" value="usuario" checked> Este usuario<br>
  <input type="radio" name="rep" value="personaje" checked> Este personaje<br>
  <br>

  <m>¿En qué infringe las normas?</m><br>
  <input type="radio" name="reporte" value="Desnudos" checked> Contenido Sexual<br>
  <input type="radio" name="reporte" value="Violencia"> Violencia o Maltrato<br>
  <input type="radio" name="reporte" value="Spam"> Spam<br>
  <input type="radio" name="reporte" value="Otro"> Otro<br> 

<br>
Comentarios:<br>
  <input type="text" name="comentario">
  <br> 
  
  <br>
  <input type="submit" value="Enviar">

</form> 
<br>
<l>Tu reporte se enviará a un administrador para su revisión.</l> <br>
	<l>Gracias por tus comentarios</l>
</section>

</body>
</html>