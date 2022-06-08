<?php 
	session_start();
	if( $_SESSION['authenticated'] != 'yes' )
	{header("location: ../../login.php");}

  
	// initialize the app
	
	include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/core/initialize.php');
  include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/includes/config.php');

	$current_user = $_SESSION['fname']; 
	$class = $_SESSION['class_name'];
	$class_id = $_SESSION['class_id'];
  $reg_num = $_SESSION['index_number'];

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Results</title>
<script type="text/javascript" src="../../common/javascript.js"></script>
<script type="text/javascript" src="results.js"></script>
<script type="text/javascript" src="show.js"></script>
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
    <h4>Select an activity</h4>
    <h3 style="background-image: url(../../images/frontpage1.png);" ><a href='../index.php'>Home</a></h3>
    <h3><a href='../registration'>Registration</a></h3>
    <h3 style="background-image: url(images/email_initiator.gif);" ><a href="#">View results</a></h3>  
    
    
 </div>
 <div class="contents">
   <div id="today" style="margin-bottom: 10px;">     
     <div class="menuBar">
        class:&nbsp; <?php echo $class ?>
     </div>
   </div>
   <a class="tabs_active" id="tab1" onclick="tabOver('Create_report', 'tab1')">Create report</a> 
   <a class="tabs" id="tab2" onclick="tabOver('Class_results', 'tab2')">Class results</a>
    
    <div id="Create_report" class="tab_body">
    <div style="background-color: #FFFFFF; padding: 10px 3px; border: 1px solid #DEE8EF;">
    <h4> <?php echo $_SESSION['fname'] . " ". $_SESSION['sname'] ?> report.</h4>
      <form action="" method="post" name="create report">
        <table width="550" border="0" cellspacing="1" cellpadding="2">
          <tr style="font-weight: bold; color: #1f3477; ">
           
          </tr>
          <tr style="font-weight: bold; background-color: #999999; ">
            <td width="140">Subject name</td>
            <td width="50">Test Score</td>
            <td width="50">Exam Score</td>
            <td width="55">Total Score</td>
            <td width="55">Grade</td>
          </tr>
          <?php
              // instantiate marks class
              $mark = new Marks($db);

              // student query
              $result = $mark->read_one($reg_num);
              //get row count
              $num = $result->rowCount();

              if( $num > 0 )
              {
                $bg = 1;
                while( $user_row = $result->fetch(PDO::FETCH_ASSOC) )
                {
                  extract( $user_row );

						$style =  "style='border-top:solid 1px #aaa'";
					
						if( $bg%2 == 0 ){
              echo "<tr style='background: #f9f9fd;'>";
            }else{
              echo "<tr style=$style>";
            }

            echo "<td align='left' $style> &nbsp;".$subj_name."</td>";
            
            echo "<td style='border-top:solid 1px #aaa'>$test_score</td>";
            echo "<td style='border-top:solid 1px #aaa'>$exam_score</td>";
            echo "<td style='border-top:solid 1px #aaa'>$total_score</td>";
            echo "<td style='border-top:solid 1px #aaa'>$grade</td>";

          echo "</tr>";
					
					$bg++;
                }
              }
          ?>
          <tr>
            <td colspan="7" style='border-top:solid 1px #aaa'>&nbsp;</td>
          </tr>
          <tr style="font-weight: bold; color: #1f3477; ">
          <?php      
          $r = $db->query("SELECT AVG(total_score) FROM marks");
          $row = $r->fetch(PDO::FETCH_ASSOC);
          ?>
            <td>Average:</td>
            <td>&nbsp; <?php 
            //$row =  mysqli_fetch_array($r);
            $xx = ceil( $row['AVG(total_score)'] ) ;
            echo $xx ;
             ?> </td>
          </tr>
          <tr style="font-weight: bold; color: #1f3477; ">
            <td>Comment:</td>
            <?php
            $c = '';
            $i = $xx;
              if( $i >= 90 && $i <=100 ){
                $c = 'Very good performance';
              }else if( $i >= 80 && $i <=89 ){
                $c = 'Good performance';
              }else if( $i >= 70 && $i <=79 ){
                $c = 'Good performance, can do better';
              }else if( $i < 70 ){
                $c = 'Work harder..';
              }
            ?>
            <td colspan="6"><textarea name="comment" cols="" rows="2"> <?php echo $c; ?> </textarea></td>
          </tr>
        </table>
      </form>  
    </div>
    </div>
    
    <div id="Class_results" class="tab_body" style="display: none;">
   
     <div id="showClassResults" style="background-color: #FFFFFF; padding: 10px 3px; border: 1px solid #DEE8EF;">
       <h4>Senior <?php echo $class;?> student results.</h4>
        <form action="" method="post">
            <table width="570" border="0" cellspacing="1" cellpadding="2">
              <tr>
                <tr style="font-weight: bold; color: #1f3477; ">
                <td width="90" align="right">Select subject:</td>
               
                <td colspan="2" align="left"><select id="selectSubject" onchange="show('<?php echo $class;?>')" >
                <option value="">&nbsp; &nbsp;</option>
				<?php
         $sub = $db->query("SELECT subj_name FROM subjects");
        
						while( $subjects = $sub->fetch(PDO::FETCH_ASSOC) )
						{
							echo "<option value='".$subjects['subj_name']."'>&nbsp;".$subjects['subj_name']."</option>";
						}
					
				?></select>
               
                <td width="50" align="right">Class:</td>
                <td colspan="3" align="left"><?php echo ".$class."  ?></td>
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
              </tr>
              
              <tr >
                <td colspan="7" style="border-top:solid 1px #aaa">&nbsp;</td>
              </tr>
            </table>
        </form>
       </div>
     </div>
</div>
</div>
<div class='btm'>
    <a href='../index.php'>Home </a>
    <a href='../registration'> Registration </a>
    <a href='#'> View results </a>
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
