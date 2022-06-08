<?php 
	session_start();
	if( $_SESSION['authenticated'] != 'yes' )
	{header("location: ../../login.php");}
	// initialize 
    include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/core/initialize.php');
    include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/includes/config.php');
	
	$access_level = $_SESSION['access_level'];

	
	$show_this = ""; //This variable will be used to determine which form to show
	//Code to change or upload person's picture
	
	
	$create_user_msg = "";
	$response = "";
	
	$login = new Login($db);

	// Code to create a new user.
	if(isset($_POST['create_new_user']))
	{
		$reg_num = $_POST['new_user_id'];
		$access_level = $_POST['user_type'];
		$user_name = $_POST['new_username'];
		$password = $_POST['new_password'];
		$error_fill = 0;

		$r = $login->run_query(" SELECT * FROM login WHERE reg_num = '$reg_num' ");

		//check for empty fields
		if ( $reg_num == "")
		{
			$create_user_msg = "<h6>error: Please enter index number or staff ID.<br/></h6>";
			$error_fill = 1;
		}


				
		// if no errors, go ahead and create user
		if ( $r->rowCount() == 0 )
		{
			$login->reg_num  = $reg_num;
			$login->uname    = $user_name;
			$login->password = $password;
			$login->level    = $access_level;

		

			if( $login->create() )
			{
				$create_user_msg = "<div class='info'><b>An account has been created for:</b><br>";
				$create_user_msg .= "<b>User:</b> $user_name<br/>";
				$create_user_msg .= "<b>Type of user:</b> $access_level<br/>";
				$create_user_msg .= "<b>Index no./ Staff ID:</b> $reg_num<br/>";
				$create_user_msg .= "<b>Password:</b> $password";
				$create_user_msg .= "<hr/>*Please take note of the password<br/>";
				$create_user_msg .= "</div>";
			}
			else{
				$create_user_msg = " User creation failed. ";
			}

			if( $access_level === "student" ){
				$i = 1;
				while( $i < 8 ){
					$stmt = $db->query("INSERT INTO marks(reg_num, subj_id) VALUES( '$reg_num', '$i' ) ");
				   $i++;
				}// while loop
			}// if
				
		}
		$show_this = "add_new_user";
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
    <a href="../index.php" style="background: url(../../images/frontpage.gif) no-repeat; padding-left: 22px;">Home</a>&nbsp;&nbsp;
    <a href="../../sign out.php" style="background: url(../../images/b_drop.png) no-repeat; padding-left: 18px;">Sign out</a>
</div>
<div id="greeting" style=" float: left;">Welcome, <?php echo $_SESSION['fname'];?></div>
</div>
  <div class="content">

  <div class="sidebar">
        <h4>Select an activity</h4>
        <h3><a href="../subjects/">View Subjects</a></h3>
        <h3 style="background-image: url(../../images/email_initiator.gif);" ><a href='../students/'>View students</a></h3>
        
        <h3><a href="../teachers/">View Teacher</a></h3>
        <h3 style="background-image: url(../../images/icon-30-cpanel.png);" ><a href="../password/">Change your password</a></h3>
		<h3 style="background-image: url(../../images/icon-30-cpanel.png);" ><a href="#">Administration</a></h3>
	</div>

     <div class="contents">
       <div id="today" style=" text-align: right; ">
       </div>
       <div style=" padding: 8px 5px; border: solid 1px #999999; background-color: #f9f9fb;">
       
	   <div class="search_box">
          <form action="" method="post" name="find_student" style="margin: 3px;">
            <table width="200" border="0">
              <tr>
                <td >SEARCH:</td>
                <td><input onkeyup="showHint(this.value)" id="search_name" onfocus="magic('on')" maxlength="25" onblur="magic('off')" /></td>
              </tr>
              <tr>
                <td><img src="images/magnify.gif" alt="search icon" /></td>
                <td align="left" style="font-size:14px; line-height: 20px">
                Find a student quickly<br/>
                <span style="color:#333333; font-size:12px">Enter name for the student in the box.</span></td>
              </tr>
            </table> 
          </form>
       </div>

       <div class='reg_form' style="padding: 0px 10px 30px 10px;">
       <br/>
      
        <!--Below is the form to create a new user. This data is stored in the login table in the database-->
        <h5 id="third">Add new system user</h5>
         <form action="<?php $_SERVER['PHP_SELF'];?>" id="add_new_user" method="post" name="add_new_user" style="margin: 10px;">
           Simply supply the information below:<br/>
           <h4 style="background:url(../images/P_Info_win.gif) left no-repeat; padding: 3px 20px; margin:5px 0px;">Password will automatically be generated.</h4>
           <table width="100%" border="0" cellpadding="5" style="color: #000000; margin: 5px 0px">
            <tr>
              <td width="14%" align="right">User ID:</td>
              <td width="40%"><input size="30" onkeyup="help_fill(this.value)" name="new_user_id" id="new_user_id" maxlength="25" style='font-size:12px;' required></td>
              <td width="18%" align="right">Type of user:</td>
              <td width="28%"><select name="user_type" id="user_type">
                <option value="student" selected="selected">Student</option>
                <option value="teacher">Teacher</option>
                <option value="staff">Administrator</option>
              </select></td>
            </tr>
              <tr>
                <td align="right">Password:</td>
                <td colspan="3"><input name="new_password" id="newu_password" size="30" maxlength="25" style='font:bold 12px Arial;' required></td>
              </tr>
              <tr>
                <td align="right">Username:<br>&nbsp;</td>
                <td colspan="3"><input name="new_username" id="new_uname" size="30" maxlength="25" style='font-size:12px;' required><br/>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4" align="right" style="border-top:solid 1px #cccccc; padding-top: 5px;" >
                  <input name="create_new_user" type="submit" value="&nbsp; create new user &nbsp;" style='font: bold 11px arial;' />
                  <input name="cancel" onclick="clearForm('add_new_user')" type="button" value="&nbsp; cancel &nbsp;" style='font: bold 11px arial;' /></td>
              </tr>
            </table>
            <?php echo $create_user_msg;?>
         </form>
        
         <br/>
       </div>
       <div id="show_hint">&nbsp;</div>
    </div>    
    </div>
</div>

<div class='btm'>
    <a href='../students/'> View students </a>
    <a href='../teachers/'> View Teachers </a>
    <a href="#"> view subjects</a>
    <br/>&copy; All rights reserved. <br/> An Ivan Masaba Production 2022
</div>

</body>
</html>