<?php 
	session_start();
	if( $_SESSION['authenticated'] != 'yes' )
	{header("location: ../../login.php");}
	// initialize 
    include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/core/initialize.php');
    include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/includes/config.php');

	$access_level = $_SESSION['access_level'];
	$second_name = $_SESSION['fname']; 

    $student = new Student($db);

    if( isset( $_POST['add'] ) ){
        
    }

    

    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>home</title>
    <link rel="stylesheet" type="text/css" href="../../styles.css">
    <link rel="stylesheet" type="text/css" href="../../personal.css">
</head>

<body>
<div class="top">
    <h1>SCHOOL MANAGER</h1>
    <h2>access your school everywhere!</h2>
</div>
<div class="bar">
<div id="current_time" style="color: #49AF3A; text-align:right; margin-bottom: 10px;"><?php echo date("l, d.M H:i", time()); ?></div>
<div style="float: right;"><a href="../sign out.php" style="background: url(../../images/b_drop.png) no-repeat; padding-left: 18px;">Sign out</a>
</div>
<div id="greeting" style=" float: left;">Welcome, <?php echo "<b>" . $second_name . "</b>"; ?></div>
</div>
  <div class="content">

     <div class="sidebar">
        <h4>Select an activity</h4>
        <h3><a href="../subjects/">View Subjects</a></h3>
        <h3 style="background-image: url(../../images/email_initiator.gif);" ><a href='#'>View students</a></h3>
        
     <h3><a href="../teachers/">View Teacher</a></h3>
        <h3 style="background-image: url(../../images/icon-30-cpanel.png);" ><a href="../password/">Change your password</a></h3>
        <h3 style="background-image: url(../../images/icon-30-cpanel.png);" ><a href="../options/">Administration</a></h3>
	</div>
     
     <div class="contents">
              
   	<div style=" padding: 8px 5px; border: solid 1px #999999; background-color: #f9f9fb;">
      <div style="padding: 5px; height: 450px; background-color:#FFFFFF">
      
         <img src="../../images/unknown_user.gif" alt="your picture" width="96" height="120" style="padding: 4px; border:solid 1px #ccc; float: left; margin-right: 8px" />
           <?php
           echo "<h2><span style='color: #777'>Index number:</span> ".$_SESSION['index_number']."</h2>";
		   echo "<h2><span style='color: #777'>Name:</span> ".$_SESSION['fname']." </h2>";
		   echo "<h2><span style='color: #777'>Access Level:</span> ".$access_level."</h2>";
		   echo "<h2></h2>";
		   echo "<p></p>";
		   echo "<p>&nbsp;</p>";
           
		   ?> 
           <table width="65%" border="0">
              <tr><td><h3>What have you been up to:</h3></td></tr>
           </table>           
           Nothing to display
           <div class="noticeBoard">Notice board.</div>

           <div>
               <form action="" method="post">
               <label">Add Student:</label>
               <input type="text" name="students" placeholder="add a student" >
               <input type="submit" value="ADD STUDENT" name="add" >
               </form>
           </div>
           

           <div class="boardB">
           	<h5>Students</h5>
               <table width="270" border="0" cellspacing="1" cellpadding="2">
              <tr>
              <td><h5>Index Number</h5></td>
              <td > <h5>Student name</h5> </td>
              <td > <h5>Class</h5> </td>
              <td > <h5>Gender</h5> </td>
             </tr>
             <?php
              $stmt = $db->query("SELECT * FROM students ");
             $num = $stmt->rowCount();

                 if( $num > 0 )
                 {
                   $bg = 1;
                   while(  $row = $stmt->fetch(PDO::FETCH_ASSOC) )
                   {
                    extract( $row );

                       if($bg%2==1)
                       {
                           echo "<tr >";
                       }
                       else
                       {
                           echo "<tr style='background: #ccc url(images/frm_chg.gif) repeat-x;'>";
                       }
                       echo "<td>".$reg_num."</td>";
                       echo "<td align='left'>".$fname. " ". $lname."</td>";

                       $sql = $db->query("SELECT class_name FROM class WHERE id = '$class_id' LIMIT 1 ");
                      if( $clas = $sql->fetch(PDO::FETCH_ASSOC)){
                          
                       echo "<td>".$clas['class_name']."</td>";
                      }
                       echo "<td>".$gender."</td>";
                       echo "</tr>";
                       $bg++;
                   }
                 }




                 
                 
               ?>
               </table>
           </div>
       </div>       
    </div>    
    </div>
</div>

<div class='btm'>
    <a href='#'> View students </a>
    <a href='../teachers/'> View Teachers </a>
    <a href="../subjects/"> view subjects</a>
    <br/>&copy; All rights reserved. <br/> An Ivan Masaba Production 2022
</div>

</body>
</html>