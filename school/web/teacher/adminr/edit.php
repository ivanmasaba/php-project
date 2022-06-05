<?php 
	session_start();
	if( $_SESSION['authenticated'] != 'yes' )
	{header("location: ../../login.php");}
	// initialize the app
	
	include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/core/initialize.php');
  include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/includes/config.php');

	$current_user = $_SESSION['fname'];
  $reg_num = $_SESSION['index_number'];
	$access_level = $_SESSION['access_level'];

  // get teacher attributes
  $teacher = new Staff($db);
  $teacher->read_one( $reg_num );



  /**** */

     $new_form_msg = "";
     
     $reg = $_GET['reg'];

     $student = new Student($db);
     $student->reg_num = $reg;
     $student->read_one();

     
  // get marks for this teacher's subject and class
  $result = $teacher->read_os( $reg, $teacher->class_name, $teacher->subj_name );


    if(isset($_POST['save']))
	{
        
    $test  = $_POST['test_score'];
		$exam  = $_POST['exam_score'];
		$total = $_POST['total_score'];
		$grade = $_POST['grade'];

       $marks = new Marks($db);

       $marks->test     =  $test ;
       $marks->exam     =  $exam ;
       $marks->total    =  $total ;
       $marks->grade    =  $grade;

       $res = $marks->update( $reg, $teacher->subj_id ); 

              if(  $res )
              {
                $new_form_msg = "<div class='info' >";
                  $new_form_msg .= "Marks updates successfully";
              }
              else{
                $new_form_msg = "<div class='warn' >";
                $new_form_msg .= $reg . ' ' .$sid . " Marks update failed. ";
            }

        $new_form_msg .= "</div>";
        
        header("location: ../adminr/"); 
        exit;
        

    }

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Results</title>
<script type="text/javascript" src="calc.js"></script>
<script type="text/javascript" src="results.js"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../styles.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="top">
    <h1>SCHOOL MANAGER</h1>
    <h2>access your school everywhere!</h2>
</div>
<div class="bar">
    <div id="current_time" style="color: #49AF3A; text-align:right; margin-bottom: 10px;"><?php echo date("l, d.M H:i", time()); ?></div>
    <div style="float: right;">
        <a href="../index.php" style="background: url(../../images/frontpage.gif) no-repeat; padding-left: 22px;">Home</a>&nbsp;&nbsp;
        <a href="../../sign out.php" style="background: url(../../images/b_drop.png) no-repeat; padding-left: 18px;">Sign out</a>
    </div>
    <div id="greeting" style=" float: left;">Welcome, <?php echo $current_user ?></div>
</div>
<div class="content">
 <div class="sidebar">
 <?php 

echo "<h4>Select an activity</h4>";
echo "<h3 style=\"background-image: url(../../images/frontpage1.png);\" ><a href=\"../index.php\">Home</a></h3>";

echo "<h3><a href=\"../adminr\">EDIT Results</a></h3>";
echo "<h3 style=\"background-image: url(../../images/email_initiator.gif);\" ><a href=\"../advres/\">View results</a></h3>";

echo "<h3><a href=\"../adminreg/\">Account info</a></h3>";
echo "<h3 style=\"background-image: url(../../images/icon-30-cpanel.png);\" ><a href=\"../options/\">Change your settings</a></h3>";

?>
    
 </div>
 <div class="contents">   
  
   <a class="tabs" id="tab2" onclick="tabOver('Class_results', 'tab2')"><?php echo $teacher->class_name;  ?> results</a>
    
    <div id="Create_report" class="tab_body">
    <div style="background-color: #FFFFFF; padding: 10px 3px; border: 1px solid #DEE8EF;">
    <div id="showClassResults">
    <h4> <?php echo 'MARKS FOR '. $student->fname . " " . $student->lname ;?></h4>
     
      <?php echo $new_form_msg; ?>
        <table width="550" height="200" border="0" cellspacing="1" cellpadding="2">
          <tr style="font-weight: bold; color: #1f3477; ">
           
          </tr>
          <tr style="font-weight: bold; background-color: #999999; ">
            <td width="140">Subject name</td>
            <td width="50">Test Score</td>
            <td width="50">Exam Score</td>
            <td width="55">Total Score</td>
            <td width="55">Grade</td>
            <td width="55"></td>
          </tr>
          <?php




$num = $result->rowCount();

if( $num > 0){
     $bg = 1;
        while($mark = $result->fetch(PDO::FETCH_ASSOC) )
        {
          extract($mark);

          if($bg%2==1)
          {
            echo "<tr >";
          }
          else
          {
            echo "<tr style='background: #e0eff6 url(images/frm_chg.gif) repeat-x;'>";
          }
  ?> <form action="" method="post" ><?php
       echo "<td>".$teacher->subj_name."</td>";
        echo "<td><input type='text' id='test_score' name='test_score' onblur='add();' size='3' value='".$test_score."' /></td>";
        echo "<td><input type='text' id='exam_score' name='exam_score' onblur='add();' size='3' value='".$exam_score."' /></td>";
        echo "<td><input type='text' id='total_score' name='total_score' size='3' value='".$total_score."'  /></td>";
        echo "<td><input type='text' id='grade' name='grade' size='3' value='".$grade."'  /></td>";
        
        echo "<td> <input  type='submit' name='save' size='3' value='SAVE MARKS'  /> </td>";
        ?>
          </form> 
        
         </form> <?php
  echo "<td>&nbsp;</td>";
  echo "<td>&nbsp;</td></tr>";
  $bg++;
}

echo  "</tr>";
}else{
  echo "No records found ";
}


          ?>
         
        </table>
        
      </div>
    </div>
    </div>
    
    
</div>
</div>
<div class='btm'>
    <a href='../index.php'>Home </a>
    <a href='../adminreg/'> Registration </a>
    <a href='../advres/'> View results </a>
    <br/>&copy; All rights reserved. <br/> 
    An Ivan Masaba Production 2022
</div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>
