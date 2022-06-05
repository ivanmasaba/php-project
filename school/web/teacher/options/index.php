<?php 
	session_start();
	if( $_SESSION['authenticated'] != 'yes' )
	{header("location: ../../login.php");}
	
	// initialize the app
	
  include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/core/initialize.php');
  include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/includes/config.php');
	
	$access_level = $_SESSION['access_level'];
    $staff_id = $_SESSION['index_number'];

	$password_change_msg = "";
	$upload_info = "";
	$create_user_msg = "";
	$response = "";
	

	
	// Code to change a user's password.
	if(isset($_POST['change_password']))
	{
		$login = new Login($db);

		require_once( 'chpassword.php' );
	}
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>options</title>
<script type="text/javascript" src="options.js"></script>
<link rel="stylesheet" type="text/css" href="../../styles.css">
<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body onload="showCorrectForm('<?php echo $show_this;?>')">
<div class="top">
    <h1>SCHOOL MANAGER</h1>
    <h2>access your school everywhere!</h2>
</div>
<div class="bar">
<div id="current_time" style="color: #49AF3A; text-align:right; margin-bottom: 10px;"><?php echo date("l, d.M H:i", time()); ?></div>
<div style="float: right;">
    <a href="../index.php" style="background: url(../images/frontpage.gif) no-repeat; padding-left: 22px;">Home</a>&nbsp;&nbsp;
    <a href="../../sign out.php" style="background: url(../images/b_drop.png) no-repeat; padding-left: 18px;">Sign out</a>
</div>
<div id="greeting" style=" float: left;">Welcome, <?php echo $_SESSION['fname'];?></div>
</div>
  <div class="content">
     <div class="sidebar">
	 <h4>Select an activity</h4>
        <h3 style="background-image: url(../../images/frontpage1.png);" ><a href='../'>Home</a></h3>
    
        <h3><a href="../adminr/">Add Results</a></h3>
        <h3 style="background-image: url(images/email_initiator.gif);" ><a href='../advres/'>View results</a></h3>
    
     <h3><a href="../adminreg/">Account info</a></h3>
        <h3 style="background-image: url(../../images/icon-30-cpanel.png);" ><a href="../options/">Change your settings</a></h3>
     </div>
     <div class="contents">
       <div id="today" style=" text-align: right; ">
       </div>
       <div style=" padding: 8px 5px; border: solid 1px #999999; background-color: #f9f9fb;">
       <div class='reg_form' style="padding: 0px 10px 30px 10px;">
       <br/>
	   
	   <form action="<?php $_SERVER['PHP_SELF'];?>"  method="post"  style="margin: 10px;">
            Enter you current password then the new one.
          <table width="100%%" border="0" cellpadding="5" style="color: #000000;">
            <tr>
              <td width="25%" align="right">Current password:</td>
              <td width="75%"><input name="old_password" type="password" size="45" maxlength="25" style='font-size:12px;'/></td>
            </tr>
              <tr>
                <td align="right">New password:</td>
                <td><input name="new_password" type="password" size="45" maxlength="25" style='font-size:12px;' /></td>
              </tr>
              <tr>
                <td align="right">Confirm password:<br>&nbsp;</td>
                <td><input name="confirm" type="password" size="45" maxlength="25" style='font-size:12px;' /><br/>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"  style="border-top:solid 1px #cccccc; padding-top: 5px;" >
                  <input name="change_password" type="submit" value="&nbsp;change password&nbsp;" style='font: bold 11px arial;' />
                </tr>
            </table>
            <?php echo $password_change_msg; ?>
       </form>
      
         <br/>
       </div>
       <div id="show_hint">&nbsp;</div>
    </div>    
    </div>
</div>
<div class='btm'>
    <a href='../index.php'>Home </a>
    <a href='../registration/'> Registration </a>
    <a href='../advres/'> View results </a>
    <a href="../options"> Change your settings</a>
    <br/>&copy; All rights reserved. <br/> An Ivan Masaba Production 2022
</div>
</body>
</html>