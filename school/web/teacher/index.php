<?php 
	session_start();
	if( $_SESSION['authenticated'] != 'yes' )
	{header("location: ../login.php");}
	// initialize 
    include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/core/initialize.php');
    include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/includes/config.php');

	$access_level = $_SESSION['access_level'];
	$second_name = $_SESSION['fname']; 
    

    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>home</title>
    <script type="text/javascript" src="../common/javascript.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <link rel="stylesheet" type="text/css" href="../personal.css">
</head>

<body>
<div class="top">
    <h1>SCHOOL MANAGER</h1>
    <h2>access your school everywhere!</h2>
</div>
<div class="bar">
<div id="current_time" style="color: #49AF3A; text-align:right; margin-bottom: 10px;"><?php echo date("l, d.M H:i", time()); ?></div>
<div style="float: right;">
    <a href="#" style="background: url(images/frontpage.gif) no-repeat; padding-left: 22px;">Home</a>&nbsp;&nbsp;
    <a href="../sign out.php" style="background: url(../images/b_drop.png) no-repeat; padding-left: 18px;">Sign out</a>
</div>
<div id="greeting" style=" float: left;">Welcome, <?php echo "<b>" . $second_name . "</b>"; ?></div>
</div>
  <div class="content">
     <div class="sidebar">
        <h4>Select an activity</h4>
        <h3 style="background-image: url(../images/frontpage1.png);" ><a href='#'>Home</a></h3>
        
        <h3><a href="adminr/">Add Results</a></h3>
        <h3 style="background-image: url(../images/email_initiator.gif);" ><a href='advres/'>View results</a></h3>
        
     <h3><a href="adminreg/">Account info</a></h3>
        <h3 style="background-image: url(../images/icon-30-cpanel.png);" ><a href="options/">Change your password</a></h3>
     </div>
     <div class="contents">
              
   	<div style=" padding: 8px 5px; border: solid 1px #999999; background-color: #f9f9fb;">
      <div style="padding: 5px; height: 450px; background-color:#FFFFFF">
      
         <img src="../images/unknown_user.gif" alt="your picture" width="96" height="120" style="padding: 4px; border:solid 1px #ccc; float: left; margin-right: 8px" />
           <?php
           echo "<h2><span style='color: #777'>Index number:</span> ".$_SESSION['index_number']."</h2>";
		   echo "<h2><span style='color: #777'>Name:</span> ".$_SESSION['fname']." ".$_SESSION['lname']."</h2>";
		   echo "<h2><span style='color: #777'>Birth day:</span> ".substr_replace( $_SESSION['birthDate'], date("Y"), -4, 4 )."</h2>";
		   echo "<h2><span style='color: #777'>e-mail:</span> ".$_SESSION['email']."</h2>";
           
           echo "<h2><span style='color: #777'>Class:</span> ".$_SESSION['class_name']."</h2>";
		   echo "<h2><span style='color: #777'>Subject:</span> ".$_SESSION['subj_name']."</h2>";
		   echo "<h2><span style='color: #777'>Email:</span> ".$_SESSION['email']."</h2>";           
           echo "<h2><span style='color: #777'>Phone Number:</span> ". $_SESSION['phone']."</h2>";
		   echo "<h2><span style='color: #777'>Address:</span> ".$_SESSION['address']."</h2>";
           
		   ?> 
           <table width="65%" border="0">
              <tr><td><h3>What have you been up to:</h3></td></tr>
           </table>           
           Nothing to display
           <div class="noticeBoard">Notice board.</div>

           <div class="boardA"><h5>Staff</h5>

           <table width="270" border="0" cellspacing="1" cellpadding="2">
              <tr>
              <td align='right'> <h5>Staff id</h5> </td>
              <td align='right' ><h5>Teacher's name</h5></td>
             </tr>
             <?php
             $teacher = new Staff($db);
             $res = $teacher->read_all();
             $num = $res->rowCount();

                 if( $num > 0 )
                 {
                   $bg = 1;
                   while(  $row = $res->fetch(PDO::FETCH_ASSOC) )
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
                       echo "<td align='center'>".$staff_id."</td>";
                       echo "<td align='center'>".$fname." ".$lname."</td>";
                       echo "</tr>";
                       $bg++;
                   }
                 }




                 
                 
               ?>
             </table>
           </div>


           <div class="boardB">
           	<h5>Students</h5>
               <table width="270" border="0" cellspacing="1" cellpadding="2">
              <tr>
              <td><h5>Index No.</h5></td>
              <td > <h5>Student name</h5> </td>
             </tr>
             <?php
                 $cname = "senior one" ;
                 $sub  = "english" ;
             $res = $teacher->read_al( $cname, $sub );
             $num = $res->rowCount();

                 if( $num > 0 )
                 {
                   $bg = 1;
                   while(  $row = $res->fetch(PDO::FETCH_ASSOC) )
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
                       echo "<td align='left'>".$fname." ".$lname."</td>";
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
    <a href='#'>Home </a>
    <a href='adminr/'> Add Results </a>
    <a href='advres/'> View results </a>
    <a href="options/"> Change your settings</a>
    <br/>&copy; All rights reserved. <br/> An Ivan Masaba Production 2022
</div>
</body>
</html>