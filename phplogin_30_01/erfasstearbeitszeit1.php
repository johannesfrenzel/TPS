
	  
	<?php 
	
	// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}


$benutzerid = $_SESSION["id"];

	
$rollenid = $_SESSION["rollenid"];


?>

<?php if ($rollenid == 1): ?>
	  
	  <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>�bersichtsseite</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">

					<nav class="navtop">
			<div>
				<!-- <h1>Zeitapp</h1> -->
				<a href="home.php"><i class="fa fa-home fa-fw"></i>�bersicht</a>
				<a href="kalender.php"><i class="fa fa-calendar"></i>Kalender</a>
				<a href="erfasstearbeitszeitausgabe.php"><i class="fa fa-user-circle"></i>Arbeitszeiten</a>
				<a href="nichtverfugbarkeitausgabe.php"><i class="fa fa-thumbs-down"></i>Nicht-Verf�gbarkeit</a>
				<a href="aufgabeausgabe.php"><i class="fa fa-tasks"></i>Aufgaben</a>
				<a href="meetingausgabe.php"><i class="fa fa-user-circle"></i>Meetings</a>
				<a href="profile.php"><i class="fa fa-cog fa-fw"></i>Einstellungen</a>
			</div>
		</nav>
		
		<div class="content">
			<p>Bitte Felder ausf�llen um Arbeitszeit zu erfassen.</p>
		</div>
		
	
		<?php
		
				include 'crud.php';
		
		$conn = OpenCon();
		
	$benutzerid = $_SESSION["id"];
        echo $benutzerid;
		
		$pdo = new PDO('mysql:host=localhost;dbname=tps', 'root', '');

    $abfrage = "SELECT kaz_von, kaz_bis FROM benutzer where benutzerid=$benutzerid";
 $row = $pdo->query($abfrage)->fetch();
$test = $row['kaz_von']; 
$test2 = $row['kaz_bis']; 

    echo $row['kaz_von'];
	  echo $row['kaz_bis'];

?>
		

<div class="content">
<div class="formular">
<label></label></br>
			<form action="erfasstearbeitszeitausfuhr.php" method="post" autocomplete="on">

<label for="beginn">Beginn: </label>
    <input type="datetime-local" min="$row['kaz_von']" max="$row['kaz_bis']" value="datetime" name="beginn" /></br>
   
<label for="ende">Ende: </label>
 <input type="datetime-local" value="datetime" name="ende" /></br>
   

<label for="beschreibung" >Beschreibung:</label>
<input type="text" name="beschreibung"	placeholder="Beschreibung" id="beschreibung" required></br>


<input type="submit" value="Arbeitszeit erfassen">

</form>
</div>
		</div>

			<button onclick="goBack()">Zur�ck</button>

<script>
function goBack() {
  window.history.back();
}
</script>

</body>
</html>



<?php endif; ?>