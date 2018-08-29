<!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"> <a href="">True-Check</a></div>
    <div class="sl-sideleft">
      <div class="input-group input-group-search">              
      </div><!-- input-group -->

      <label class="sidebar-label">Menú</label>
      <div class="sl-sideleft-menu">
        <a href="index.html" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Home</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="registro.php" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
            <span class="menu-item-label">Registro</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->            
      </div><!-- sl-sideleft-menu -->
      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">User<span class="hidden-md-down"> Test</span></span>
              <img src="../img/img3.jpg" class="wd-32 rounded-circle" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                <li><a href=""><i class="icon ion-ios-gear-outline"></i> Settings</a></li>
                <li><a href=""><i class="icon ion-ios-download-outline"></i> Downloads</a></li>
                <li><a href=""><i class="icon ion-ios-star-outline"></i> Favorites</a></li>
                <li><a href=""><i class="icon ion-ios-folder-outline"></i> Collections</a></li>
                <li><a href=""><i class="icon ion-power"></i> Sign Out</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>        
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->
    
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="/">Kugel Electronics</a>
        <span class="breadcrumb-item active">Registro</span>
      </nav>
            
      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Registro EDS</h5>
          <p>Se realiza el registro de la estación para el control y emparejamiento de la prueba con el lugar de realización.</p>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Información de la Estación de Servicio</h6>
          <p class="mg-b-20 mg-sm-b-30">Registre la información solicitada.</p>
          <form action="" method="post">
            <div class="form-layout">
              <div class="row mg-b-25">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Nombre Estación: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="name" value="" placeholder="Ingrese nombre EDS" required>                  
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Dirección EDS: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="address" value="" placeholder="Dirección EDS" required>
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Teléfono: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="phone" value="" placeholder="Teléfono" required>
                  </div>
                </div><!-- col-4 -->
                <div class="col-lg-8">
                  <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Encargado: </label>
                    <input class="form-control" type="text" name="manager" value="" placeholder="Administrador">
                  </div>
                </div><!-- col-8 -->              
              </div><!-- row -->
  
              <div class="form-layout-footer">
                <input class="btn btn-info mg-r-5" type="submit" name="enviar" value="Enviar" />              
                <input  class="btn btn-secondary" type="reset" value="Limpiar"/>
              </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
          </form>
          <p></p>
          <?php 
            if (filter_input(INPUT_POST,'enviar')) {   
              $dbconn = pg_connect("host=127.0.0.1 dbname=truecheck user=db_admin password='12345'")
              or die('Can not connect: ' . \pg_last_error());                                                                                
              $nombre    = filter_input(INPUT_POST,'name');
              $direccion = filter_input(INPUT_POST,'address');
              $telefono  = filter_input(INPUT_POST,'phone');
              $encargado = filter_input(INPUT_POST,'manager');
              $query = "INSERT INTO EDS (nombreEstacion, direccionEstacion, telefonoEstacion, encargadoEstacion) VALUES('$nombre','$direccion','$telefono','$encargado') ";
              $result = pg_query($query) or die('Query error: ' . \pg_last_error());
              // Liberando el conjunto de resultados
              pg_free_result($result);
              // Cerrando la conexión
              pg_close($dbconn);
              echo "<div class='row mg-b-25'>
                      <div class='col-lg-8'>
                        <h3 class='tx-success tx-lato tx-center mg-b-15'>Gracias, hemos recibido su información.</h3>
                      </div>
                      <div class='col-lg-4'>
                        <div class='link-php'>
                          <a href='tanque.php' class='btn btn-outline-success btn-block mg-b-10'>Continuar</a>                            
                        </div>
                      </div>
                    </div>";
            }
          ?>
        </div><!-- card -->
              

      </div><!-- sl-pagebody -->
      <footer class="sl-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright &copy; 2018. Kugel Electronics. All Rights Reserved.</div>          
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/starlight"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Starlight,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/starlight"><i class="fa fa-twitter tx-20"></i></a>
        </div>
      </footer>
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="../lib/jquery/jquery.js"></script>
    <script src="../lib/popper.js/popper.js"></script>
    <script src="../lib/bootstrap/bootstrap.js"></script>
    <script src="../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../lib/highlightjs/highlight.pack.js"></script>
    <script src="../lib/select2/js/select2.min.js"></script>

    <script src="../js/starlight.js"></script>
    <script>
      $(function(){
        'use strict';

        $('.select2').select2({
          minimumResultsForSearch: Infinity
        });
      });
    </script>