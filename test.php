<?php 

$name = 'vasile';
$email = 'vasile@caca.com';

$sql = "SELECT * FROM test WHERE nume = ? AND email = ?"; 
$query = $con->query("SELECT * FROM test"); 

$stm_prepare  = $con->prepare($sql);
$stm_prepare->execute([$name,$email]);

$emails = $stm_prepare->fetchAll();

foreach($emails as $email){
	echo $email['email'];
	echo "<hr>";
}

while($row = $query->fetch() ){
	echo $row['nume'] . "<br>";
}

?>