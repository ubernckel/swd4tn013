<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
		
		<p>Parse my csv. Let's go!</p>
		
		
		<?php
		$row = 1;
		//make sure you can open test.csv
		if (($handle = fopen("test.csv", "r")) !== FALSE) {
			//repeat until
			echo "<table>";
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				$num = count($data);
				//echo "<p> $num fields in line $row: <br /></p>\n";
				echo "<tr>";
				//extract all cells
				for ($c=0; $c < $num; $c++) {
					echo "<td>" . $data[$c] . "</td>";
					
				}
				echo "</tr>";
				$row++;
			}
			fclose($handle);
		}
		echo "</table>";
		?>

    </body>
</html>

