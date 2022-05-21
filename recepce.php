<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

  # pripojeni k databazi
  include('databaze.php');

if(!$dbconn){
die('Database connection failed: ' . mysqli_connect_error());
}

if($_POST['jmeno']){
    $name = $_POST['jmeno'];
}else{
    echo "name not received";
    exit;
}

if($_POST['druh']){
    $druh = $_POST['druh'];
}else{
    echo "phone not received";
    exit;
}

if($_POST['vek']){
    $vek = $_POST['vek'];
}else{
    echo "email not received";
    exit;
}

if($_POST['kontakt']){
    $kontakt = $_POST['kontakt'];
}else{
    echo "message not received";
    exit;
}

echo gettype($vek);

$stmt = $dbconn->prepare("INSERT INTO patient_log (animal_name, species, age, mail) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $druh, $vek, $kontakt);
$stmt->execute();

// Commit transaction
if (!$dbconn -> commit()) {
  echo "Commit transaction failed";
  exit();
}

$dbconn -> close();

header("Refresh:0; url=vet_recepce.php")

?> 