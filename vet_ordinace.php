<!DOCTYPE html>
<html lang="cs">
<head>
<title>ORDINACE</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="vet_recepce.php" class="w3-bar-item w3-button w3-padding-large">VET RECEPCE</a>
    <a href="vet_ordinace.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">VET ORDINACE</a>
    <a href="prehled_pacientu.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">PREHLED PACIENTU</a>
    <a href="prehled_zakroku.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">PREHLED ZAKROKU</a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">README</a>
   </div>
</div>

<!-- The Contact Section -->
  <div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="contact">
    <h2 class="w3-wide w3-center">VYSETRENI</h2>
    <p class="w3-opacity w3-center"><i>Vyplnte udaje:</i></p>
 
<?php   
    include('vysetreni.php')
?>     
 
  </div>

</html>