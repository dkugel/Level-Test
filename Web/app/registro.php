<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/adons.css">
    <title>Registro de EDS</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-2">
          <a href="../index.html"><img src="../img/kugel_trans_peq.png" style="padding-top: 1em;"></a>
        </div>
        <div class="col-8">          
          <h1>Registro EDS</h1>
          <div id="app">            
            <h2>{{sub}}</h2>
            <h3>{{msg2}}</h3>
            <form class="formulario" method="post" action="">
              <label>Nombre estación:</label>
              <input v-model="estacion" placeholder="Nombre de estación" name="name" required>
              <label>Dirección EDS:</label>
              <input v-model="direccion" placeholder="Dirección de estación" name="address" required>
              <label>Teléfono EDS:</label>
              <input v-model="telefono" placeholder="Número telefónico" name="phone" required>
              <label>Encargado EDS:</label>
              <input v-model="encargado" placeholder="Administrador / Encargado" name="manager" >
              <p>{{ estacion }}<br>{{direccion}}<br>{{telefono}}<br>{{encargado}}</p>              
              <div class="row">
                <div class="col-6">
                  <input class="btn btn-info" type="submit" name="enviar" value="Enviar" />
                </div>
                <div class="col-6">
                  <input  class="btn btn-secondary" type="reset" value="Limpiar"/>
                </div>
              </div>
            </form><br>
            <p>Si los datos son correctos presione el botón "Enviar"</p>
            <?php
              if (filter_input(INPUT_POST,'enviar')) {   
                  $dbconn = pg_connect("host=127.0.0.1 dbname=truecheck user=db_admin password='12345'")
                  or die('Can not connect: ' . \pg_last_error());                                                                                
                  $nombre    = filter_input(INPUT_POST,'name');
                  $direccion = filter_input(INPUT_POST,'address');
                  $telefono  = filter_input(INPUT_POST,'phone');
                  $encargado = filter_input(INPUT_POST,'manager');
                  $query = "INSERT INTO EDS (nombreestacion, direccionestacion, telefonoestacion, encargadoestacion) VALUES('$nombre','$direccion','$telefono','$encargado') ";
                  $result = pg_query($query) or die('Query error: ' . \pg_last_error());
                  // Liberando el conjunto de resultados
                  pg_free_result($result);
                  // Cerrando la conexión
                  pg_close($dbconn);
                  echo '<h3>Gracias, hemos recibido su información.</h3>
                        <div class="link-php">
                          <a href="tanque.php" class="btn btn-outline-success ">Prueba Tanque</a>                                                    
                          <a href="linea.php" class="btn btn-outline-success ">Prueba Línea</a>                            
                        </div>
                        ';
                }
            ?>
          </div>
          
        </div>
        <div class="col-2">        
        </div>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="../js/main.js"></script>
    
  </body>
</html>
