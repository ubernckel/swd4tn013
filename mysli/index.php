<!DOCTYPE html>
<html lang="fi">
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Müesli</title>
</head>
<body>


<html>
<head>
<title>
Müesli
</title>
</head>
<body>
<h1>Müesli</h1>

<?php
print('moe');

$db=new PDO("mysql:host=localhost;dbname=a1602804","a1602804","viKEUE76y");
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$sql = "SELECT * FROM user_info";
$stmt = $db->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetchObject()) {
	print("<p>Kommentti: " . utf8_encode(row->kommentti));
}

print("<br> Yhteensä " . $stmt->rowCount() . " kommenttia"); 




?>

</body>
</html>



