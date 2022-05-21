<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include('databaze.php');
  include('index.php');
  include('pacienti.php');
  include('prehled_pacientu.php');
  include('prehled_zakroku.php');
  include('recepce.php');
  include('vet_ordinace.php');
  include('vet_recepce.php');


 ?>