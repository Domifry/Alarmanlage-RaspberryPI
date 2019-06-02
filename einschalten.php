<?php
    
	function einschalten() {
     //TODO Datenbank und PW eintragen
    $con=mysqli_connect("localhost","DATENBANKNAME","PASSWORT","DATENBANKNAME");
    
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
     //TODO Datenbank und PW eintragen
    $sql = "UPDATE  `DATENBANKNAME`.`Status` SET  `wert` =  '1' WHERE  `Status`.`ID` =1 AND  `Status`.`wert` =0 LIMIT 1 ;";
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
	}
     //TODO CODE EINTRAGEN
    function nachricht() {
        $url = 'https://www.pushsafer.com/api';
        $data = array(
                      't' => urldecode("Status"),
                      'm' => urldecode("Alarm ist jetzt an!"),
                      's' => 3,
                      'v' => 2,
                      'i' => 23,
                      'k' => "DEINCODE"
                      );
        $options = array(
                         'http' => array(
                                         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                         'method'  => 'POST',
                                         'content' => http_build_query($data)
                                         )
                         );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
    }
    ?>
    
    <html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  
    <link rel="stylesheet" href="/main.css">
    <title>Penthouse Alarmanlage</title>
  </head>
    <body>
     <nav class=" navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="#">Penthouse Alarmanlage</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">

      </div>
    </nav>
       <main role="main" class="container">
      <div class="jumbotron">
        <h1>Alarmstatus</h1>
        <p class="lead">Der Alarm ist jetzt eingeschaltet!</p>
<?php einschalten(); nachricht(); ?>
	      <!-- TODO: deine Domain -->
       <a class="btn btn-lg btn-primary" href="https://deine-domain.de/alarm/" role="button">zurück zur Seite</a>
       
      </div>
    </main>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>
