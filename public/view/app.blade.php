<?php use App\Providers\Session; App\Helpers\HTML::csrf(); $app = app(); ?>
<!--header area-->
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agri-Trading Online Shop | @yield('title') </title>

    <!-- Bootstrap core CSS-->
    <link href= "{!! $app->get('APP_URL').'/public/assets/css/bootstrap.min.css' !!}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{!! $app->get('APP_URL').'/public/assets/css/all.min.css' !!}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{!! $app->get('APP_URL').'/public/assets/css/dataTables.bootstrap4.css' !!}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{!! $app->get('APP_URL').'/public/assets/css/sb-admin.css' !!}" rel="stylesheet">

      <link href="{!! $app->get('APP_URL').'/public/assets/css/cart_style.css' !!}" rel="stylesheet">
      <script type='application/x-javascript'> 
        addEventListener('load', function(){setTimeout(hideURLbar, 0); }, false); 
        function hideURLbar(){window.scrollTo(0,1);}
      </script>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="{!! route('home') !!}">Agri-Trading</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">

        <?php  if (isset($_SESSION[app()->get('CURRENT_USER_SESSION_NAME')])): ?>
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link " href="{!! route('profile') !!}">
              <i class=" fas fa-user-circle" > {{ $_SESSION['name']}}</i>
            </a>
          </li>
          
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link " href="{!! route('logout') !!}" data-toggle="modal" data-target="#logoutModal"><i class=" fas fa-sign-out-alt" >Logout</i></a>
          </li>
        <?php else: ?>
          <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link " href="{!! route('register') !!}"><i class="fas fa-user-alt ">Sign Up</i></a>
          </li>
          
          <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link " href="{!! route('login') !!}" id="userDropdown"><i class=" fas fa-sign-in-alt" > Login</i></a>
          </li>
        <?php endif; ?>

      </ul>
    </nav>

      <!--sidebar area-->
      <div id="wrapper">
        <ul class="sidebar navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{!! route('home') !!}">
              <i class="fas fa-fw fa-home"></i>
                <span>Home</span>
            </a>
          </li>

          <?php $cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
          
          <li class="nav-item">
            <?php if (isset($_POST['add_to_cart'])): ?>
              <a title="Order" class="nav-link" href="{!! route('order/cart') !!}"><i class="fas fa-fw fa-shopping-cart"></i>Cart</a>
            <?php else: ?>
              <a title="Order" class="nav-link" href="{!! route('order/cart') !!}">
                <i class="fas fa-fw fa-shopping-cart"></i> Cart <span class="text-danger">{{ $cart }}</span>
              </a>
            <?php endif; ?>
          </li>
          
          
          @if( isset($_SESSION[ $app->get('CURRENT_USER_SESSION_NAME') ]) )
          
          <li class="nav-item">
            <a title="List of Orders" class="nav-link" href="{!! route('order/history') !!}">
            <i class="fas fa-fw fa-th-list"></i>
            <span>List of Orders</span></a>
          </li>

          <li class="nav-item">
            <a title="List of Orders" class="nav-link" href="{!! route('profile') !!}">
            <i class="fas fa-fw fa-user-alt "></i>
            <span>Profile</span></a>
          </li>
            @if( Session::exists('wallet') )  
              <li class="nav-item">
                <a title="List of Orders" class="nav-link" href="{!! route('profile/wallet') !!}">
                <i class="fas fa-fw fa-th-list"></i>
                <span>Wallet ({!! Session::get('wallet') !!} NGN)</span></a>
              </li>
            @endif

            @if( Session::get('role') == 'admin' )  
              <li class="nav-item">
                <a title="List of Orders" class="nav-link" href="{!! route('products') !!}">
                <i class="fas fa-fw fa-th-list"></i>
                <span>Supplier DashBoard</span></a>
              </li>

              <li class="nav-item">
                <a title="List of Orders" class="nav-link" href="{!! route('admin') !!}">
                <i class="fas fa-fw fa-th-list"></i>
                <span>Admin DashBoard</span></a>
              </li>
            @endif

          @endif

        </ul>        
            
        <div id="content-wrapper">
          <div class="container-fluid">
          
            @yield('content')
          
          </div>

        </div>
        <!-- /.content-wrapper -->

      </div>
      <!-- /#wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
      </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © AGRI... 2018</span>
            </div>
          </div>
        </footer>

</body>


<!-- Bootstrap core JavaScript-->
<script src="{!! $app->get('APP_URL').'/public/assets/js/jquery.min.js' !!}"></script>
<script src="{!! $app->get('APP_URL').'/public/assets/js/bootstrap.bundle.min.js' !!}"></script>

<!-- Core plugin JavaScript-->
<script src="{!! $app->get('APP_URL').'/public/assets/js/jquery.easing.min.js' !!}"></script>

<!-- Page level plugin JavaScript-->
<script src="{!! $app->get('APP_URL').'/public/assets/js/Chart.min.js' !!}"></script>
<script src="{!! $app->get('APP_URL').'/public/assets/js/jquery.dataTables.js' !!}"></script>
<script src="{!! $app->get('APP_URL').'/public/assets/js/dataTables.bootstrap4.js' !!}"></script>

<!-- Custom scripts for all pages-->
<script src="{!! $app->get('APP_URL').'/public/assets/js/sb-admin.min.js' !!}"></script>

<!-- Demo scripts for this page-->
<script src="{!! $app->get('APP_URL').'/public/assets/js/demo/datatables-demo.js' !!}"></script>
<script src="{!! $app->get('APP_URL').'/public/assets/js/demo/chart-area-demo.js' !!}"></script>

</html>