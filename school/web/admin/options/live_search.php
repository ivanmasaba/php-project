<?php
	header("Cache-Control: no-cache, must-revalidate");
	 // Date in the past
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

	// initialize 
    include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/core/initialize.php');
    include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/includes/config.php');

	$response = "";
	$hint = $_GET["hint"];
	$hint .= '%';
	$num = 1;

	$stmt = $db->query("SELECT * FROM students  WHERE fname LIKE '$hint' || lname LIKE '$hint' ");
	$num = $stmt->rowCount();


		if( $num > 0 )
		{
			echo "<table width='100%' cellspacing='0' cellpadding='3'>";
			echo "<tr style='background:#053a83; color: #FFFFFF'>";
			echo "<th scope='col'> # </th>";
			echo "<th scope='col'> Registration number </th>";
			echo "<th scope='col'> Full name </th>";
			echo "<th scope='col'> Class </th>";
			echo "<th scope='col'> Access Level </th></tr>";

			while (  $row = $stmt->fetch(PDO::FETCH_ASSOC) )
			{
				extract($row);

				if( $num%2 == 1 )
				{
					echo "<tr><td>".$num.".</td>";
					echo "<td>".$reg_num."</td>";
					echo "<td>".$fname." ".$lname."</td>";

					$sql = $db->query("SELECT class_name FROM class WHERE id = '$class_id' LIMIT 1 ");
					if( $clas = $sql->fetch(PDO::FETCH_ASSOC)){
						
					 echo "<td>".$clas['class_name']."</td>";
					}

					

					$sq = $db->query("SELECT level FROM login WHERE reg_num = '$reg_num' LIMIT 1 ");
					if( $l = $sq->fetch(PDO::FETCH_ASSOC)){
						
					 echo "<td>".$l['level']."</td>";
					}
				}
				else
				{
					echo "<tr style='background:#F4F5FD;'><td>".$num.".</td>";
					echo "<td>".$reg_num."</td>";
					echo "<td>".$fname." ".$lname."</td>";					

					$sql = $db->query("SELECT class_name FROM class WHERE id = '$class_id' LIMIT 1 ");
					if( $clas = $sql->fetch(PDO::FETCH_ASSOC)){
						
					 echo "<td>".$clas['class_name']."</td>";
					}
					
					

					$sq = $db->query("SELECT level FROM login WHERE reg_num = '$reg_num' LIMIT 1 ");
					if( $l = $sq->fetch(PDO::FETCH_ASSOC)){
						
					 echo "<td>".$l['level']."</td>";
					}
					
				}
				$num++;
			}
			echo "</table>";
		}
		else
			$response = "No results ";
		
		echo $response;	


?>