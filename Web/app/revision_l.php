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
          <h1>Revisión</h1>
          <div id="app">            
            <h2>{{msg4}}</h2>            
            <form class="formulario" method="post" action="">
              <label>Serial Tanque:</label>
              <?php
                $dbconn = pg_connect("host=127.0.0.1 dbname=truecheck user=db_admin password='12345'")
                or die('Can not connect: ' . \pg_last_error());
                $query = "SELECT  pkidlinea, identificacionlinea FROM linea ORDER BY pkidlinea;";
                $result = pg_query($query) or die('Query error: ' . \pg_last_error());
                echo "<select v-model='selected'  data-placeholder='Seleccione Línea' name='select1'>";
                  echo "<option disabled value=''>Seleccione Línea</option>";
                while($fila=  pg_fetch_row($result)){
                  echo "<option value=".$fila[0].">".$fila[1]."</option>";
                }
                echo "</select>";
                pg_close($dbconn);
              ?>
              <p></p>
              <div class="row" >
                <div class="col-6">
                  <input class="btn btn-info" type="submit" name="enviar" value="Iniciar Test" />
                </div>
                <div class="col-6">
                  <input  class="btn btn-danger" type="submit" name="detener" value="Detener Test"/>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <a class="btn btn-warning" href="../index.html" style="margin: 20px 25%;">Regresar a inicio</a>
                </div>
              </div>
            </form><br>
            
            <?php              
              if (filter_input(INPUT_POST,'enviar')) {   
                  $dbconn = pg_connect("host=127.0.0.1 dbname=truecheck user=db_admin password='12345'")
                  or die('Can not connect: ' . \pg_last_error());
                  $tanque = filter_input(INPUT_POST,'select1');                                                  
                  $query  = "INSERT INTO sensor_presion (fkidlinea, valoranalogo, activartest, horamedicion) VALUES('$tanque',0,'1',LOCALTIMESTAMP) ";
                  $result = pg_query($query) or die('Query error: ' . \pg_last_error());
                  // Liberando el conjunto de resultados
                  pg_free_result($result);
                  // Cerrando la conexión
                  pg_close($dbconn);

                  echo "<h2 class='tx-success'>Gracias, La prueba ha iniciado correctamente.</h2>";
              }
              if (filter_input(INPUT_POST,'detener')) {   
                  $dbconn = pg_connect("host=127.0.0.1 dbname=truecheck user=db_admin password='12345'")
                  or die('Can not connect: ' . \pg_last_error());                                                 
                  $query  = "UPDATE sensor_presion SET activartest = '0' WHERE idmedicion = (SELECT MAX(idmedicion) FROM sensor_presion);";                  
                  $result = pg_query($query) or die('Query error: ' . \pg_last_error());
                  // Liberando el conjunto de resultados
                  pg_free_result($result);
                  // Cerrando la conexión
                  pg_close($dbconn);

                  echo "<h2 class='tx-success'>La prueba ha finalizado.</h2>";
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
