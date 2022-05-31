<?php 
	session_start();

	// initialize the api
	include_once( '../core/initialize.php' );

	$login  = new Login($db);
    $student = new Student($db);
	$teacher = new Staff($db);
	$msg = "";
	$message = "";

	
	if(isset($_POST['login']))
	{
	  $errors = array();
	
	//clean up the form data before putting in the database
	$msg = "<div >";
	$uname = trim($_POST['uname']);
	$password = trim($_POST['password']);

	   if(!empty($uname) && !empty($password) ){

			// get the reg_num from the url using GET method
			// check if it exist if not die() or end
			$login->uname    = $uname  ;
			$login->password = $password;
			//call the read one method
			$result = $login->read_one();
			$num = $result->rowCount();

			if( $num > 0 ){
			
				 $row = $result->fetch(PDO::FETCH_ASSOC);
					$login->reg_num  = $row['reg_num'];
                    $login->uname    = $row['uname'];
                    $login->level    = $row['level'];
				
			
				
					if($login->level == 'student')
					{
						$_SESSION['fname'] = $login->uname;

						$_SESSION['index_number'] = $login->reg_num;
						
						$_SESSION['access_level'] = $login->level;

						$student->reg_num = $login->reg_num;
					    $student->read_one();

						$_SESSION['sname'] = $student->lname;

						$_SESSION['gender'] = $student->gender;

						$_SESSION['class_id'] = $student->class_id;

						$_SESSION['class_name'] = $student->class_name;

						$_SESSION['birthDate'] = $student->birth_date;

						$_SESSION['fathersname'] = $student->father_name;

						$_SESSION['mothers_name'] = $student->mother_name;

						$_SESSION['parent_number'] = $student->parent_phone;

						$_SESSION['parent_address'] = $student->parent_address;

						$_SESSION['authenticated'] = 'yes';

						header("location: ./student/"); 
						exit;
					}
					else if($login->level == 'teacher')
					{
						$_SESSION['fname'] = $login->uname;

						$_SESSION['index_number'] = $login->reg_num;
						
						$_SESSION['access_level'] = $login->level;

						$teacher->read_one($login->reg_num);

						$_SESSION['class_id']      = $teacher->class_id;
						
						$_SESSION['lname']         = $teacher->lname;

						$_SESSION['subject_id']    = $teacher->subj_id;

						$_SESSION['class_name']    = $teacher->class_name;

						$_SESSION['subj_name']     = $teacher->subj_name;

						$_SESSION['birthDate']     = $teacher->birth_date;

						$_SESSION['email']         = $teacher->email;

						$_SESSION['phone']         = $teacher->phone;

						$_SESSION['address']       = $teacher->address;

					    $_SESSION['authenticated'] = 'yes';
					header("location: ./teacher/"); 
					exit;
					}					
					
				}else{
					$msg = 'Incorrect password for ' . $login->uname;
				   }
			
			}else{
				$msg = ' login fields are empty';
			   }
		$msg .= "</div>";

	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>School Manager</title>
    <script src="getuser.js"></script>
    <script type="text/javascript" src="getuser.js"></script>
    <link rel="stylesheet" type="text/css" href="default.css">
</head>

<body>
  <div class="school_manager">
     <div class="top">
        <h1>SCHOOL MANAGER</h1>
        <h2>access your school everywhere!</h2>
     </div>
     <div class="bar">
     	<div style="float: left; font: normal 16px 'Arial';">Login page</div>
        <div id="current_time" style="float: right; color: #999999"><?php echo date("l, d.M", time())."<br>".date("H:i", time()); ?></div>
     </div>
     <div class="content">
      <fieldset>  
       <legend>login to proceed </legend>
        <form action="login.php" method="post" >
        <table width="330" border="0" align="center" cellpadding="2">
          <tr>
            <td width="115" rowspan="2" style=" font-weight: normal;"><img src="images/connected_data_big copy.gif" />
            <br /> Enter your username and password.</td>
            <td width="205"><br>
              <label >User name:</label><br>
            <input name="uname" value="mathew" type="text" size="30" maxlength="20" id="user_name" /></td>
          </tr>
          <tr>
            <td><label >Password:</label><br>
            <input name="password" value="2" type="password" size="30" maxlength="20" /></td>
          </tr>
          <tr>
            <td width="115" rowspan="2" style=" font-weight: normal;">&nbsp;</td>
            <td><input name="login" type="submit" value="login" class="submit" /></td>
          </tr>
          <tr>
            <td id="response">&nbsp;<?php
   echo "<p class=\"message\">" . $msg .
		  "</p>";	
			// echo $msg; 
			?></td>
          </tr>
			 <tr>
			  <td> Student:</td><td>username: martha </td><td>password:1 </td>
   		  </tr>
        </table>
      </form>
      </fieldset>
     </div>
     <div class='btm'>&copy; All rights reserved. <br/> An Ivan Masaba Production 2022</div>
   </div>
</body>
</html>
