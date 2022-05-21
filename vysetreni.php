<?php 
  include('databaze.php');
?>

<?php
  # seznam pacientu
  $sql = 'SELECT ID_patient, animal_name FROM patient_log';
  $result = $dbconn->query($sql);
  if(!$result) {
    die('CHYBA DATABAZE: '.$dbconn->error);
  }
  $patients = $result->fetch_all(MYSQLI_ASSOC);

  # seznam procedur
  $sql = 'SELECT ID_treatment, treatment_type FROM treatment_plan';
  $result = $dbconn->query($sql);
  if(!$result) {
    die('CHYBA DATABAZE: '.$dbconn->error);
  }
  $procedures = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="w3-row m6">
        <form  method="POST">
 
          ID pacienta:
	  <select class="w3-select" name="option_patient">
		 <option value="" disabled selected>ID a jmeno pacienta</option>
 		 <?php
                    foreach($patients as $patient) {
                      echo '<option value="' . $patient['ID_patient'] . '">' . $patient['ID_patient'] ." - ". $patient['animal_name'] . '</option>';
        		  }
       		 ?>		
		</select>

	  Nalez:
          <input class="w3-input w3-animate-input" type="text" placeholder="Nalez" required name="finding">

	  Plan lecby:
	  <select class="w3-select" name="option_treatment">
		 <option value="" disabled selected>Lecebny plan</option>
 		 <?php
                    foreach($procedures as $procedure) {
                      echo '<option value="' . $procedure['ID_treatment'] . '">' . $procedure['ID_treatment'] ." - ". $procedure['treatment_type'] . '</option>';
        		  }
       		 ?>		
		</select>

	  <input class="w3-check" type="checkbox" checked="checked" name = "chk1" value="1">
	  <label class="w3-validate">Urgentni</label>

          <button class="w3-button w3-black w3-section w3-right" type="submit" value = "submit" name = "submit">ODESLAT</button>
        </form>
      </div>
 </div>

<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

if($_SERVER['REQUEST_METHOD']=="POST"){

if($_POST['option_treatment']){
    $treatment = $_POST['option_treatment'];
}else{
    echo "finding not received";
    exit;
}

if($_POST['option_patient']){
    $patient = $_POST['option_patient'];
}else{
    echo "finding not received";
    exit;
}


if($_POST['finding']){
    $finds = $_POST['finding'];
}else{
    echo "finding not received";
    exit;
}

$isChecked = (isset($_POST['chk1']) && $_POST['chk1'] == 1) ? 1 : 0;

$stmt = $dbconn->prepare("INSERT INTO vet_exam_log(Patient_log_ID_patient, findings, treatment_plan_ID_treatment, urgency) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isii", $patient, $finds, $treatment, $isChecked);
$stmt->execute();


// Commit transaction
if (!$dbconn -> commit()) {
  echo "Commit transaction failed";
  exit();

}
}

$dbconn -> close();



?> 


