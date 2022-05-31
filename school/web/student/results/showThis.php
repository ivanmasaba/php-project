<?php
  
  // initialize the app
  
include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/core/initialize.php');
include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/includes/config.php');

$class = $_GET['class'];
$subject = $_GET['subject'];

echo '
		<table width="570" border="0" cellspacing="1" cellpadding="2">
		  <tr>
			<tr style="font-weight: bold; color: #1f3477; ">
			<td width="90" align="right">Select subject:</td>
			<td colspan="2" align="left"><select id="selectSubject" onchange="show(\''.$class.'\')" >		
				<option value="'.$subject.'">&nbsp; '.$subject.' &nbsp;</option> ';
				$sub = $db->query("SELECT subj_name FROM subjects");
					while( $subjects = $sub->fetch(PDO::FETCH_ASSOC) )
					{
						
						echo "<option value='".$subjects['subj_name']."'>&nbsp;".$subjects['subj_name']."</option>";
					}
				
			echo '
			<td width="50" align="right">Class:</td>
			<td colspan="3" align="left"> '.$class.' </td>
		  </tr>
		  <tr >
			<td colspan="7">&nbsp;</td>
		  </tr>
		  <tr style="font-weight: bold; background-color: #999999; ">
			<td>Index No.</td>
			<td width="170" >Student name</td>
			<td width="50">Test score</td>
			<td width="50">Exam score</td>
			<td width="50">Total score</td>
			<td width="50">Grade</td>
		  </tr>';
//   $query = $db->query("SELECT reg_num, fname, lname FROM students WHERE class_id = '{$class}' ");
		//   if($db_result = $cxn->query($query))
		//   {
// $student = $db->query("SELECT c.class_name, s.reg_num, s.fname, s.lname, m.test_score, m.exam_score, m.total_score, m.grade, sb.subj_name 
// FROM class c INNER JOIN students s ON c.id=s.class_id INNER JOIN marks m ON s.reg_num=m.reg_num INNER JOIN subjects sb ON m.subj_id=s.id  
// WHERE c.class_name='$class' AND m.subj_id=1");
			
// $student = $db->query("SELECT students.reg_num, students.fname, students.lname, marks.test_score, marks.exam_score, marks.total_score, marks.grade, subjects.subj_name  FROM students, marks, subjects  WHERE students.class_id=$class AND students.reg_num=marks.reg_num AND marks.subj_id=$subject AND marks.subj_id=subjects.id"
// );

    $mark = new Marks($db);

	$result = $mark->read_all( $class, $subject );

	 //get row count
	 $num = $result->rowCount();

	 if( $num > 0 ){


			$bg = 1;
			while($students = $result->fetch(PDO::FETCH_ASSOC))
			{
				extract( $students );

				if($bg%2==1)
				{
					echo "<tr >";
				}
				else
				{
					echo "<tr style='background: #e0eff6 url(../../images/frm_chg.gif) repeat-x;'>";
				}
				echo "<td>".$reg_num."<input type='hidden' name='".$bg."' size='3' value='".$reg_num."' /></td>";
				echo "<td align='left'>".$fname." ".$lname."</td>";
				
	//  $query3 = "SELECT marks.test_score, marks.exam_score, marks.total_score, marks.grade
	//  		   FROM marks, subjects
	//  		   WHERE marks.reg_num='{$students['reg_num']}' AND subjects.subj_name='{$subject}' AND marks.subj_id=subjects.id  ";

				// if($ds = $cxn->query($query3))
				// {
					// while($student = $query3->fetch(PDO::FETCH_ASSOC))
					// {
							echo "<td>".$test_score."</td>";
							echo "<td>".$exam_score."</td>";
							echo "<td>".$total_score."</td>";
							echo "<td>".$grade."</td>";
					//}
				// } 
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td></tr>";
				$bg++;
			}
		//	echo $db_result->error;
		//	echo $db_result->num_rows;
		// 	$db_result->close();
		  }
		//   else echo $cxn->error;
		//   $cxn->close();
		  echo '<tr >
			<td colspan="7" style="border-top:solid 1px #aaa">&nbsp;</td>
		  </tr>
		</table>';
   
?>