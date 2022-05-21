<?php 
  # pripojeni k databazi
  include('databaze.php');
?>

<?php
   $result = $dbconn->query('SELECT NOW()');
  $row = $result->fetch_row();
  echo '<div>Cas: '.$row[0].'</div>';

  $sql = 'SELECT COUNT(*)FROM vet_exam_log WHERE urgency = 1';
  $result = $dbconn->query($sql);
  if(!$result) {
    die('CHYBA DATABAZE: '.$dbconn->error);
  }
  $urgent = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php

  $sql = 'SELECT COUNT(*)FROM vet_exam_log WHERE urgency = 0';
  $result = $dbconn->query($sql);
  if(!$result) {
    die('CHYBA DATABAZE: '.$dbconn->error);
  }
  $nonurgent = $result->fetch_all(MYSQLI_ASSOC);
?>

<p>Pocet zakroku dnes:</p>

<?php if (count($urgent) > 0): ?>
<table id="ExamLog" name="examlog" novalidate="" action="prehled_zakroku.php" method="post">
<table class="w3-table-all" style="width:10%">
  <tr class="w3-red w3-xlarge">
        <th>Urgentni</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($urgent as $row): array_map('htmlentities', $row); ?>
    <tr class="w3-xlarge">
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

<?php if (count($nonurgent) > 0): ?>
<table id="ExamLog" name="examlog" novalidate="" action="prehled_zakroku.php" method="post">
<table class="w3-table-all" style="width:10%">
  <tr class="w3-green w3-xlarge">
        <th>Neurgentni</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($nonurgent as $row): array_map('htmlentities', $row); ?>
    <tr class="w3-xlarge">
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>


 <p>Prehled registrovanych zakroku:</p>
<?php
  $sql = 'SELECT * FROM vet_exam_log INNER JOIN patient_log ON vet_exam_log.patient_log_ID_patient = patient_log.ID_patient INNER JOIN treatment_plan ON vet_exam_log.treatment_plan_ID_treatment = treatment_plan.ID_treatment ORDER BY urgency';
  $result = $dbconn->query($sql);
  if(!$result) {
    die('CHYBA DATABAZE: '.$dbconn->error);
  }
  $patient = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php
if(isset($_GET['vet_exam_log']))
{
  # uvozovky VZDY kolem escapovaneho stringu, i kdyz by melo jit
  # o ciselnou hodnotu!!!
  $sql = 'SELECT * FROM vet_exam_log WHERE id="?id"';
  $sql_safe = safe_sql_string(
    $sql, ['id'=>$_GET['vet_exam_log']], $dbconn);
  
  echo '<pre>'.$sql_safe.'</pre>';
  $result = $dbconn->query($sql_safe);
  if(!$result) {
    die('CHYBA DATABAZE: '.$dbconn->error);
  }
  $vet_exam_log = $result->fetch_all(MYSQLI_ASSOC);
  
  echo '<pre>vet_exam_log ID_patient='.$_GET['vet_exam_log']."\n";
  print_r($vet_exam_log);
  echo '</pre>';
}
?>

<table id="ExamLog" name="examlog" novalidate="" action="prehled_zakroku.php" method="post">
<table class="w3-table-all" style="width:80%">
  <tr class="w3-light-grey">
        <th>ID vysetreni</th>
        <th>ID pacienta</th>
        <th>Jmeno pacienta</th>
        <th>Datum</th>
        <th>Nalez</th>
        <th>Zakrok</th>
        <th>Urgence</th>
      </tr>
<?php
    foreach($patient as $row) {
      echo "  <tr>\n";
      echo "    <td>".$row['ID_exam']."</td>\n";
      echo "    <td>".$row['Patient_log_ID_patient']."</td>\n";
      echo "    <td>".$row['animal_name']."</td>\n";
      echo "    <td>".$row['date']."</td>\n";
      echo "    <td>".$row['findings']."</td>\n";
      echo "    <td>".$row['treatment_type']."</td>\n";
      echo "    <td>".$row['urgency']."</td>\n";
      echo "  </tr>\n";
    }
  ?>
</table>


<?php

  $sql = 'SELECT * FROM treatment_plan_has_vet LEFT JOIN treatment_plan ON treatment_plan_has_vet.treatment_plan_ID_treatment = treatment_plan.ID_treatment
INNER JOIN vet ON treatment_plan_has_vet.vet_ID_vet = vet.ID_vet ORDER BY vet_name';
  $result = $dbconn->query($sql);
  if(!$result) {
    die('CHYBA DATABAZE: '.$dbconn->error);
  }
  $treatment = $result->fetch_all(MYSQLI_ASSOC);

?>


<p>Prehled vykonavanych zakroku a prirazeni ordinujicim lekarum:</p>


<table id="ExamLog" name="examlog" method="post">
<table class="w3-table-all w3-hoverable" style="width:50%">
  <tr class="w3-light-grey">
        <th>Zakrok</th>
        <th>Veterinar</th>
      </tr>
<?php
    foreach($treatment as $row) {
      echo "  <tr>\n";
      echo "    <td>".$row['treatment_type']."</td>\n";
      echo "    <td>".$row['vet_name']."</td>\n";
      echo "  </tr>\n";
    }
  ?>
</table>



