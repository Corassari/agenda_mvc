<?php
//require_once 'model/Conn.class.php';
//require_once 'model/ModelAgenda.php';
require_once 'controller/ControllerAgenda.php';

//$ag = new Agenda();


$controller = new ControllerAgenda();
!empty(filter_input(INPUT_GET, 'year')) ? $controller->setYear(filter_input(INPUT_GET, 'year')) : NULL;
!empty(filter_input(INPUT_GET, 'month')) ? $controller->setMonth(filter_input(INPUT_GET, 'month')) : NULL;
!empty(filter_input(INPUT_GET, 'day')) ? $controller->setDay(filter_input(INPUT_GET, 'day')) : NULL;
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/fonts/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="css/bootstrap.css">

        <title>Agenda</title>
    </head>
    <body>
        <div class="container"  >
            <div class="alert alert-grey">
                <h1 class="text-right">AGENDA <strong><?= $controller->getYear() ?></strong> </h1>   
            </div>
            <div class="row">
                <?php
                error_reporting(E_ALL);
                $controller->redirectPage();
                $controller->actions();
                ?>
            </div><!-- end.row formulario-->
        </div><!-- end.container -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/jquery-1.10.1.min.js"></script>
        <!--<script src="js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <!--<script src="js/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
        <script src="js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/form-mask/jquery.mask.js"></script>
        <script src="js/datepicker/bootstrap-datepicker.js"></script>
        <script src="js/common.js"></script>
    </body>
</html>