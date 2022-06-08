<?php 
	session_start();
	if( $_SESSION['authenticated'] != 'yes' )
	{header("location: ../../login.php");}
	// initialize the app
	
	include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/core/initialize.php');
  include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/includes/config.php');

	$current_user = $_SESSION['fname'];
	$access_level = $_SESSION['access_level'];
	$staff_id = $_SESSION['index_number'];

	$current_user_type = 'new';
	if( $current_user_type == 'new' )
	{	$tab1='tabs_active'; $tab2='tabs'; }
  	else
	{	$tab2='tabs_active'; $tab1='tabs'; }

	$password_change_msg = "";
	$form_msg = "";
	$new_form_msg = "";
	
  

	$teacher = new Staff($db);

	$result = $teacher->run_query("SELECT * FROM staff WHERE staff_id = :reg ");
    $result->execute( array( ":reg" => $staff_id ) );

	$num = $result->rowCount();

	if( $num == 0 ){
		$lname = "";
		$class = "";
		$subj_id = "";
		$gender = "";
		$birth_date = "";
		$email = "";
		$name = "";
		$phone = "";
		$address = "";
  }else{
    $bool = "true";
    while( $row = $result->fetch(PDO::FETCH_ASSOC) ){
		$lname = $row['lname'];
		$class =  $row['class_id'];
		$gender =  $row['gender'];
		$birth_date = $row['birth_date'];
		$staff_id = $row['staff_id'];
		$email = $row['email'];
		$phone = $row['phone'];
		$subj_id = $row['subj_id'];
		$address = $row['address'];
    }
  }

  	
	// Code for validating then regestering students.
	if(isset($_POST['reg_new'])){

		require_once( 'new_teacher.php' );
  
	} 
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>registration</title>
<script type="text/javascript" src="../../common/javascript.js"></script>
<script type="text/javascript" src="registration.js"></script>
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" type="text/css" href="../../styles.css">
</head>

<body>
<div class="top">
    <h1>SCHOOL MANAGER</h1>
    <h2>access your school everywhere!</h2>
</div>
<div class="bar">
<div style="float: right;">
    <a href="../index.php" style="background: url(../../images/frontpage.gif) no-repeat; padding-left: 22px;">Home</a>&nbsp;&nbsp;
    <a href="../../sign out.php" style="background: url(../../images/b_drop.png) no-repeat; padding-left: 18px;">Sign out</a>
</div>
<div id="greeting" style=" float: left;">Welcome, <?php echo "<b>" . $current_user . "</b>"; ?></div>
</div>
  <div class="content">
     <div class="sidebar">

	 <h4>Select an activity</h4>
        <h3 style="background-image: url(../../images/frontpage1.png);" ><a href='../'>Home</a></h3>
        
        <h3><a href="../adminr/">Add Results</a></h3>
        <h3 style="background-image: url(images/email_initiator.gif);" ><a href='../advres/'>View results</a></h3>
        
     <h3><a href="../adminreg/">Account info</a></h3>
        <h3 style="background-image: url(../../images/icon-30-cpanel.png);" ><a href="../options/">Change your password</a></h3>
     </div>

     <div class="contents">
       <div id="today" style=" text-align: right; ">
         <div id="noticeState" style="font: bold 11px 'Arial'; padding: 0px 10px 10px 10px;">&nbsp;</div>
       </div>
       
        <a href="#" id="tab1" class="<?php echo $tab1; ?>" onclick="tabOver('composeNotice', 'tab1')">New <?php echo $access_level;  ?></a>
        
        <div id="composeNotice" style=" padding: 0px 5px; border: solid 1px #999999; background-color: #f9f9fb; 
		<?php if( $current_user_type == 'new' )
                echo "display: block";
              else
                echo "display: none"; ?>" >
          <form name='new_student' method='post' action="<?php $_SERVER['PHP_SELF']; ?>" >
            <?php echo $new_form_msg; ?> <div class='reg_form'>
            <table width='100%' border='0' cellpadding='1' cellspacing='0'>
              <tr>
                <td colspan='2'><h5>Personal information &nbsp;</h5></td>
              </tr>
              <tr >
                <td width='25%' align='right'>First name:</td>
                <td width='75%'><input name='fname' type='text' value="<?php echo $current_user; ?>" size='35' maxlength='20'disabled></td>
              </tr>
              <tr>
                <td align='right'>Other name:</td>
                <td><input name='lname' type='text' value="<?php echo $lname; ?>" size='35' maxlength='30' /></td>
              </tr>
              <tr >
                <td align='right'>Staff id:</td>
                <td><input name='index_number' type='text' value="<?php echo $staff_id; ?>" size='1'  disabled/></td>
              </tr>
              <tr>
                <td align='right'>Class:</td>
                <?php 
				$teacher->read_one($staff_id);
                // $stmt = $db->query("SELECT class_name FROM class WHERE id = '$class' LIMIT 1 ");
                // $c = $stmt->fetch(PDO::FETCH_ASSOC);
                   ?>
                <td><select name='class' >
                        <option value=''></option>
                        <option value='1' <?php if(isset($class) && $teacher->class_name=="senior one") echo "selected"; ?>>Senior one</option>
                        <option value='2'' <?php if(isset($class) && $teacher->class_name=="senior two") echo "selected"; ?>>Senior two</option>
                        <option value='3'' <?php if(isset($class) && $teacher->class_name=="senior three") echo "selected"; ?>>Senior three</option>
                        <option value='4'' <?php if(isset($class) && $teacher->class_name=="senior four") echo "selected"; ?>>Senior four</option>
                    </select></td></tr>
					<tr>
                <td align='right'>Subject:</td>
                <?php
		        // $stm = $db->query("SELECT subj_name FROM subjects WHERE id = '$subj_id' LIMIT 1 ");
                // $sb = $stm->fetch(PDO::FETCH_ASSOC);
                   ?>
                <td><select name='subject' >
                        <option value=''></option>
                        <option value='1' <?php if(isset($subj_id) &&  $teacher->subj_name=="english") echo "selected"; ?>>english</option>
                        <option value='2'' <?php if(isset($subj_id) && $teacher->subj_name=="mathematics") echo "selected"; ?>>mathematics</option>
                        <option value='3'' <?php if(isset($subj_id) && $teacher->subj_name=="chemistry") echo "selected"; ?>>chemistry</option>
                        <option value='4'' <?php if(isset($subj_id) && $teacher->subj_name=="biology") echo "selected"; ?>>biology</option>
                        <option value='5'' <?php if(isset($subj_id) && $teacher->subj_name=="physics") echo "selected"; ?>>physics</option>
                        <option value='6'' <?php if(isset($subj_id) && $teacher->subj_name=="history") echo "selected"; ?>>history</option>
                        <option value='7'' <?php if(isset($subj_id) && $teacher->subj_name=="geography") echo "selected"; ?>>geography</option>
                    </select></td></tr>
                    <tr><td align='right'>gender:</td>
                    <td><select name='gender'>
                        <option value=''></option>
                        <option value='male' <?php if(isset($gender) && $teacher->gender=="male") echo "selected"; ?>>&nbsp;Male&nbsp;</option>
                        <option value='female' <?php if(isset($gender) && $teacher->gender=="female") echo "selected"; ?>>&nbsp;Female&nbsp;</option>
                    </select></td>
              </tr>
              <tr >
                <td align='right'>Date of birth:</td>
                <td ><input name='birth_date' type='date' id="birth_date" value="<?php echo $birth_date; ?>" ></td>
              </tr>
            <tr>
                <td colspan='2'><h5>Parent information &nbsp;</h5></td>
              </tr>
                <td align='right'>Email:</td>
                <td><input name='email' type='text' value="<?php echo $email; ?>" size='35' maxlength='40' /></td>
              </tr>
              <tr >
                <td align='right'>Phone number:</td>
                <td><input name='phone' type='text' value="<?php echo $phone; ?>" size='35' maxlength='30' /></td>
              </tr>
              <tr>
                <td align='right'>Home Address:</td>
                <td><input name='address' type='text' value="<?php echo $address; ?>" size='35' maxlength='50' /></td>
              </tr>
              <tr>
                <td><input type='text' id="h" value="<?php echo $bool; ?>" size='10' hidden /></td>
              </tr>
            </table>
            </div>
            <input name='reg_new' type='submit' value='register' style='font: bold 11px arial; margin: 10px 0px;'/>
          </form>
        </div>
        
        <div id="viewMessages" style=" padding: 0px 8px; border: solid 1px #999999; background-color: #f9f9fb;
		<?php if( $current_user_type == 'new' )
                echo "display: none";
              else
                echo "display: block"; ?>">
         
        </div>
        
    </div>
</div>

<div class='btm'>
    <a href='../'>Home </a>
    <a href='../adminr/'> Add Results </a>
    <a href='../advres/'> View results </a>
    <a href="../options/"> Change your settings</a>
    <br/>&copy; All rights reserved. <br/> An Ivan Masaba Production 2022
</div>

</body>
</html>
