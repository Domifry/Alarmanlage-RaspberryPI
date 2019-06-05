<?php
 
function werte() {
	
	// Create connection
$con=mysqli_connect("localhost","DATENBANKNAME","PASSWORT","DATENBANKNAME");
 
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
// This SQL statement selects ALL from the table 'Locations'
$sql = "SELECT * FROM `Alarme` ORDER BY `ID` DESC LIMIT 0 , 20";
 
// Check if there are results
$counter = 1;
if ($result = mysqli_query($con, $sql))
{
	// Loop through each row in the result set
    while($row = $result->fetch_array()) {
		// Add each row into our results array
		$temp = $row['Zeit'];
		$datum1 = substr($temp,0,11);
		$datum = substr($datum1,8,-1).".".substr($datum1,5,-4).".".substr($datum1,0,-7);
		$zeit = substr($temp,10);
		echo('    <tr>
      <th scope="row">'.$counter.'</th>
      <td>'.$row['Sensor'].'</td>
      <td>'.$datum.'</td>
      <td>'.$zeit.'</td>
    </tr>');
		$counter++;
	}
} return;
	} 
	
	function alarmstatus () {
		// Create connection
		$con=mysqli_connect("localhost","DATENBANKNAME","PASSWORT","DATENBANKNAME");
		// Check connection
		if (mysqli_connect_errno())
		{
 		 echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		 $sql1 = "SELECT * FROM  `Status` WHERE  `ID` =1";
			if ($result = mysqli_query($con, $sql1))
			{
				$row = $result->fetch_array();
					$wert = $row['wert'];
			}
			if ($wert == 1){
				return("Der Alarm ist aktuell an!");
			} else {
				return("Alarm ist aktuell aus!");
			}
			// Close connections
			mysqli_close($con);
				}
				
					function alarmbutton() {
		// Create connection
		$con=mysqli_connect("localhost","DATENBANKNAME","PASSWORT","DATENBANKNAME");
		// Check connection
		if (mysqli_connect_errno())
		{
 		 echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		 $sql1 = "SELECT * FROM  `Status` WHERE  `ID` =1";
			if ($result = mysqli_query($con, $sql1))
			{
				$row = $result->fetch_array();
					$wert = $row['wert'];
			}
			if ($wert == 1){
				return('  <a class="btn btn-lg btn-primary" href="https://deine-domain.de/alarm/ausschalten.php" role="button">Alarm ausschalten</a>');
			} else {
				return('  <a class="btn btn-lg btn-primary" href="https://deine-domain.de/alarm/einschalten.php" role="button">Alarm einschalten</a>');
			}
			// Close connections
			mysqli_close($con);
				}
	function alarmstatus1() {
		// Create connection
		$con=mysqli_connect("localhost","DATENBANKNAME","PASSWORT","DATENBANKNAME");
		// Check connection
		if (mysqli_connect_errno())
		{
 		 echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		 $sql1 = "SELECT * FROM  `Status` WHERE  `ID` =2";
			if ($result = mysqli_query($con, $sql1))
			{
				$row = $result->fetch_array();
					// Add each row into our results array
					$wert = $row['wert'];
			}
			if ($wert == 1){
				return("Der Neustart Alarm ist aktuell an!");
			} else {
				return("Der Neustart Alarm ist aktuell aus!");
			}
			// Close connections
			mysqli_close($con);
				}
				
					function alarmbutton1() {
		// Create connection
		$con=mysqli_connect("localhost","DATENBANKNAME","PASSWORT","DATENBANKNAME");
		// Check connection
		if (mysqli_connect_errno())
		{
 		 echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		 $sql1 = "SELECT * FROM  `Status` WHERE  `ID` =2";
			if ($result = mysqli_query($con, $sql1))
			{
				$row = $result->fetch_array();
					// Add each row into our results array
					$wert = $row['wert'];
			}
			if ($wert == 1){
				return('  <a class="btn btn-lg btn-primary" href="https://deine-domain.de/alarm/ausschalten1.php" role="button">Alarm ausschalten</a>');
			} else {
				return('  <a class="btn btn-lg btn-primary" href="https://deine-domain.de/alarm/einschalten1.php" role="button">Alarm einschalten</a>');
			}
			mysqli_close($con);
				}
?>

<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  
    <link rel="stylesheet" href="/main.css">
    
    <title>Alarmanlage</title>
  </head>
    <body>
     <nav class=" navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="#">Alarmanlage</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      </div>
    </nav>

      <!-- Hier steht irgend ein Inhalt -->
      <main role="main" class="container">
      <div>
      <h1>Alle Alarme</h1>
        <p class="lead">Hier findet sich eine Liste aller Alarme.</p>
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Sensor</th>
      <th scope="col">Datum</th>
      <th scope="col">Zeit</th>
    </tr>
  </thead>
  <tbody>
  <?php echo(werte());?>
  </tbody>
</table>
      </div>
      <br /><br />
       <main role="main" class="container">
      <div class="jumbotron">
        <h1>Alarmstatus</h1>
        <p class="lead"><?php echo(alarmstatus()); ?></p>
       <?php echo(alarmbutton()); ?>
      </div>
    </main>  <br /><br />
	             <main role="main" class="container">
      <div class="jumbotron">
        <h1>Alarm für Neustart</h1>
        <p class="lead"><?php echo(alarmstatus1()); ?></p>
       <?php echo(alarmbutton1()); ?>
      </div>
    </main>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>
