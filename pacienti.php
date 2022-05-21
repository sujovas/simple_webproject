<?php 
  # pripojeni k databazi
  include('databaze.php');
?>

<?php
  $result = $dbconn->query('SELECT NOW()');
  $row = $result->fetch_row();
  echo '<div>Cas: '.$row[0].'</div>';

  $sql = 'SELECT * FROM patient_log';
  $result = $dbconn->query($sql);
  if(!$result) {
    die('CHYBA DATABAZE: '.$dbconn->error);
  }
  $patient = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php
if(isset($_GET['patient_log']))
{
  # uvozovky VZDY kolem escapovaneho stringu, i kdyz by melo jit
  # o ciselnou hodnotu!!!
  $sql = 'SELECT * FROM patient_log WHERE id="?id"';
  $sql_safe = safe_sql_string(
    $sql, ['id'=>$_GET['patient_log']], $dbconn);
  
  echo '<pre>'.$sql_safe.'</pre>';
  $result = $dbconn->query($sql_safe);
  if(!$result) {
    die('CHYBA DATABAZE: '.$dbconn->error);
  }
  $patient_log = $result->fetch_all(MYSQLI_ASSOC);
  
  echo '<pre>patient_log ID_patient='.$_GET['patient_log']."\n";
  print_r($patient_log);
  echo '</pre>';
}

?>

<table id="PatientLog" name="patientlog" novalidate="" action="prehled_pacientu.php" method="post">
<table class="w3-table-all">
  <tr class="w3-light-grey">
        <th>ID</th>
        <th>Jmeno</th>
        <th>Druh</th>
        <th>Vek</th>
        <th>e-mail</th>
      </tr>
<?php
    foreach($patient as $row) {
      echo "  <tr>\n";
      echo "    <td>".$row['ID_patient']."</td>\n";
      echo "    <td>".$row['animal_name']."</td>\n";
      echo "    <td>".$row['species']."</td>\n";
      echo "    <td>".$row['age']."</td>\n";
      echo "    <td>".$row['mail']."</td>\n";
      echo "  </tr>\n";
    }
  ?>
</table>

<div class="w3-row m6">
        <form  method="post" action="generate_pdf.php">
		<button class="w3-button w3-black w3-section w3-right" type="submit" id="pdf" name = "generate_pdf">VYGENEROVAT PDF</button>
        </form>
      </div>

</body>

</html>