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
            <?php              
              if (filter_input(INPUT_POST,'enviar')) {   
                $dbconn = pg_connect("host=127.0.0.1 dbname=truecheck user=db_admin password='12345'")
                or die('Can not connect: ' . \pg_last_error());
                $ideds     = filter_input(INPUT_POST,'select1');
                $serial    = filter_input(INPUT_POST,'serial');                                    
                $capacidad = filter_input(INPUT_POST,'capacity');
                $unidad    = filter_input(INPUT_POST,'select2');
                $producto  = filter_input (INPUT_POST,'product');                                  
                $query = "INSERT INTO tanque (fkidestacion, capacidadtanque, unidadmedida, productotanque,serialtanque) VALUES('$ideds','$capacidad','$unidad','$producto','$serial') ";
                $result = pg_query($query) or die('Query error: ' . \pg_last_error());
                // Liberando el conjunto de resultados
                pg_free_result($result);
                // Cerrando la conexión
                pg_close($dbconn);

                echo '<h3>Gracias, hemos recibido su información.</h3>
                      <div class="link-php">
                        <a href="revision.php" class="btn btn-outline-success ">Selección Tanque</a>                                                                                                      
                      </div>
                      ';
              }
            ?>
            <form class="formulario" method="post" action="">
              <label>Nombre estación:</label>
              <?php
                $dbconn = pg_connect("host=127.0.0.1 dbname=truecheck user=db_admin password='12345'")
                or die('Can not connect: ' . \pg_last_error());
                $query = "SELECT  ideds, nombreestacion FROM EDS ORDER BY ideds;";
                $result = pg_query($query) or die('Query error: ' . \pg_last_error());
                echo "<select v-model='selected'  data-placeholder='Seleccione EDS' name='select1'>";
                  echo "<option disabled value=''>Seleccione EDS</option>";
                while($fila=  pg_fetch_row($result)){
                  echo "<option value=".$fila[0].">".$fila[1]."</option>";
                }
                echo "</select>";
                pg_close($dbconn);
              ?>
              <label>Serial:</label>
              <input v-model="serial" placeholder="Serial del Tanque" name="serial" required>
              <label>Capacidad del tanque:</label>
              <input v-model="capacidad" placeholder="2000" name="capacity" required>
              <label>Unidad de almacenamiento:</label>
              <select v-model='selected2' data-placeholder="Escoja unidad" name='select2'>
                <option disabled value="">Escoja unidad</option>
                <option value="G">Galón Americano</option>
                <option value="UK">Galón Británico</option>
                <option value="L">Litros</option>                     
              </select>
              <label>Producto:</label>
              <input v-model="producto" placeholder="Producto" name="product" required>
              <p>{{ selected }}<br>{{serial}}<br>{{capacidad}}<br>{{selected2}}<br>{{producto}}</p>
              <div class="row" >
                <div class="col-6">
                  <input class="btn btn-info" type="submit" name="enviar" value="Enviar" />
                </div>
                <div class="col-6">
                  <input  class="btn btn-secondary" type="reset" value="Limpiar"/>
                </div>
              </div>
            </form><br>
            <p>Si los datos son correctos presione el botón "Enviar"</p>
            
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
