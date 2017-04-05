<html>
 <head>
  <title>
   Ajannäyttö
  </title>
  <meta charset = "UTF-8">
  <meta http-equiv="refresh" content="1">
 </head>

<body>



<?php
	/* Luodaan muuttuja  */
	// ja tässä on kommentti 

	$aika = time();
	$pvm = date("d.m.Y");

	// Tulostetaan
	print($aika) . " sekuntia kulunut vuodesta 1970";
	print "<br>";
	print "Tänään on suunnilleen " . ($pvm) ;
	print " Kello on n.  " . date ("H.m.s") ;

	print "<br>";
	print "Toisin sanoen ".date(j).".".date(n).". Herran vuotta ".date(Y);
	print "<br>";
	print "Paras arvaukseni on, että tulit tänne osoitteesta " . $_SERVER['REMOTE_ADDR'];


?>









</body>

</html>

