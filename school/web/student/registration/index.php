<?php 
	session_start();
	if( $_SESSION['authenticated'] != 'yes' )
	{header("location: ../../login.php");}

	
	// initialize the app
	
	include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/core/initialize.php');
  include_once( $_SERVER['DOCUMENT_ROOT'].'/frontend/school/includes/config.php');

	$access_level = $_SESSION['access_level'];
	$current_user = $_SESSION['fname']; 
	
	$login  = new Login($db);
  $student = new Student($db);


	$current_user_type = 'new';
	if( $current_user_type == 'new' )
	{	$tab1='tabs_active'; $tab2='tabs'; }
  	else
	{	$tab2='tabs_active'; $tab1='tabs'; }

	$password_change_msg = "";
	$form_msg = "";
	$new_form_msg = "";
	$class = "";

  $fname = $current_user;
  $index_number = $_SESSION['index_number'];
	
  $stmt = $student->run_query("SELECT * FROM students WHERE reg_num = :reg ");
  $stmt->execute( array( ":reg" => $index_number ) );
  
  //get row count
  $num = $stmt->rowCount();

  if( $num == 0 ){
		$lname = "";
		$class = "";
		$gender = "";
		$birth_date = "";
		$father_name = "";
		$mother_name = "";
		$parent_phone = "";
		$parent_address = "";
  }else{
    $bool = "true";
    while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
		$lname = $row['lname'];
		$class =  $row['class_id'];
		$gender =  $row['gender'];
		$birth_date = $row['birth_date'];
		$father_name = $row['father_name'];
		$mother_name = $row['mother_name'];
		$parent_phone = $row['parent_phone'];
		$parent_address = $row['parent_address'];
    }
  }


	 
		// account password
		$old_password = "";
		$new_password = "";
		$confirm = "";
	
	
	
	
	// Code for validating then regestering students.
	if(isset($_POST['update'])){

	  require_once( 'chpassword.php' );

  } else if(isset($_POST['reg_new'])){

    require_once( 'new_student.php' );
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>registration</title>
<script type="text/javascript" src="../../../common/javascript.js"></script>
<script type="text/javascript" src='../../../includes/jquery-1.9.1.min.js'></script>
<script type="text/javascript" src="registration.js"></script>
<link rel="stylesheet" type="text/css" href="../../styles.css">
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
     <?php 

echo "<h4>Select an activity</h4>";
echo "<h3 style=\"background-image: url(../../images/frontpage1.png);\" ><a href=\"../index.php\">Home</a></h3>";
echo "<h3><a href='#'>Registration</a></h3>";
echo "<h3 style=\"background-image: url(../../images/email_initiator.gif);\" ><a href=\"../results/\">View results</a></h3>";

?>
     </div>
     <div class="contents">
       <div id="today" style=" text-align: right; ">
         <div id="noticeState" style="font: bold 11px 'Arial'; padding: 0px 10px 10px 10px;">&nbsp;</div>
       </div>
       
        <a href="#" id="tab1" class="<?php echo $tab1; ?>" onclick="tabOver('composeNotice', 'tab1')"> <strong>Register bio info</strong </a>
        <a href="#" id="tab2" class="<?php echo $tab2; ?>" onclick="tabOver('viewMessages', 'tab2')"><strong>Change password</strong></a>
        
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
                <td width='75%'><input name='fname' type='text' value="<?php echo $fname; ?>" size='35' maxlength='20'disabled></td>
              </tr>
              <tr>
                <td align='right'>Other name:</td>
                <td><input name='lname' type='text' value="<?php echo $lname; ?>" size='35' maxlength='30' /></td>
              </tr>
              <tr >
                <td align='right'>Index number:</td>
                <td><input name='index_number' type='text' value="<?php echo $index_number; ?>" size='1'  disabled/></td>
              </tr>
              <tr>
                <td align='right'>Class:</td>
                <?php 
                $stmt = $db->query("SELECT class_name FROM class WHERE id = '$class' LIMIT 1 ");
                $c = $stmt->fetch(PDO::FETCH_ASSOC);
                   ?>
                <td><select name='class' >
                        <option value=''></option>
                        <option value='1' <?php if(isset($class) && $c=="senior one") echo "selected"; ?>>Senior one</option>
                        <option value='2'' <?php if(isset($class) && $c=="senior two") echo "selected"; ?>>Senior two</option>
                        <option value='3'' <?php if(isset($class) && $c=="senior three") echo "selected"; ?>>Senior three</option>
                        <option value='4'' <?php if(isset($class) && $c=="senior four") echo "selected"; ?>>Senior four</option>
                    </select>
                    &nbsp;gender:
                    <select name='gender'>
                        <option value=''></option>
                        <option value='male' <?php if(isset($gender) && $gender=="male") echo "selected"; ?>>&nbsp;Male&nbsp;</option>
                        <option value='female' <?php if(isset($gender) && $gender=="female") echo "selected"; ?>>&nbsp;Female&nbsp;</option>
                    </select></td>
              </tr>
              <tr >
                <td align='right'>Date of birth:</td>
                <td ><input name='birth_date' type='date' id="birth_date" value="<?php echo $birth_date; ?>" ></td>
              </tr>
            <tr>
                <td colspan='2'><h5>Parent information &nbsp;</h5></td>
              </tr>
              <tr >
                <td align='right'>Father's name:</td>
                <td><input name='fathers_name' type='text' value="<?php echo $father_name; ?>" size='35' maxlength='40' /></td>
              </tr>
              <tr>
                <td align='right'>Mother's name:</td>
                <td><input name='mothers_name' type='text' value="<?php echo $mother_name; ?>" size='35' maxlength='40' /></td>
              </tr>
              <tr >
                <td align='right'>Parent phone number:</td>
                <td><input name='parent_phone' type='text' value="<?php echo $parent_phone; ?>" size='35' maxlength='30' /></td>
              </tr>
              <tr>
                <td align='right'>Parent's home Address:</td>
                <td><input name='parent_address' type='text' value="<?php echo $parent_address; ?>" size='35' maxlength='50' /></td>
              </tr>
              <tr>
                <td><input type='text' id="h" value="<?php echo $bool; ?>" size='10' hidden /></td>
              </tr>
            </table>
            </div>
            <input name='reg_new' type='submit' id="btn" value='register' style='font: bold 11px arial; margin: 10px 0px;'/>
          </form>
          <script>
        $(document).ready(function(){
         // var t = $("#h :input").val();
          if($("#h").val() === 'true'){
            $("#btn").prop("disabled", true);
          }
        });
      </script>
        </div>
        
        <div id="viewMessages" style=" padding: 0px 8px; border: solid 1px #999999; background-color: #f9f9fb;
		<?php if( $current_user_type == 'new' )
                echo "display: none";
              else
                echo "display: block"; ?>">
         <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="continuing" >
            <input name='update' type='submit' value='change password' style='font: bold 11px arial; margin: 10px 0px;'/><br />
            <div class='reg_form'>	
            <table width="595px" border="0" cellpadding="4">
              <tr>
                <td colspan='3'><h5>Change Password &nbsp;</h5></td>
              </tr>
              <tr >
                <td align='right'>Current password:</td>
                <td><input name='old_password' type='password' size='35' maxlength='20' /></td>
                <td>&nbsp;</td>
              </tr>
              <tr >
                <td align='right'>New password:</td>
                <td><input name='new_password' type='password' size='35' maxlength='20' /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align='right'>Confirm password:</td>
                <td><input name='confirm' type='password' size='35' maxlength='20' /></td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </div>
            <input name='update' type='submit' value='change password' style='font: bold 11px arial; margin: 10px 0px;'/><br />
			<?php echo $password_change_msg; ?>
			</form>
     
        </div>
        
    </div>
</div>
<div class='btm'>
    <a href='../index.php'>Home </a>
    <a href='#'> Registration </a>
    <a href='../results/'> View results </a>
    <br/>&copy; All rights reserved. <br/> An Ivan Masaba Production 2022
</div>
</body>
</html>
