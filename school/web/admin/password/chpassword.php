<?php

$error_fill = 0;
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm'];
//check for empty fields
$form_msg = "<div class='info' >";
foreach( $_POST as $field => $value )
{
    if ( $value == "")
    {
        $password_change_msg .= "*All fields must be filled out.<br/>";
        $error_fill = 1;
    }
}

$stmt = $login->run_query("SELECT password FROM login WHERE reg_num = :reg ");
$stmt->execute( array( ":reg" => $staff_id ) );
$row = $stmt->fetch( PDO::FETCH_ASSOC );
$login->password = $row['password'];


//verify user's current password for security purpose
        if( $login->password != $old_password)
        {
            $password_change_msg = "<h6>error:".$login->password." The current password entered is incorrect<br/></h6>";
            $error_fill = 1;		
        }
        //verify that the passwords that have been entered are the same
        else if ( $new_password != $confirm_password)
        { 
            $password_change_msg = "<h6>error: Passwords supplied do not match<br/></h6>"; 
            $error_fill = 1;
        }

// if no errors, go ahead and change passwords
if ( $error_fill == 0 )
{
    $login->password = $new_password;
    $login->reg_num = $staff_id;
    $login->update();

    $password_change_msg = "<div class='info'>Your password has been succesfully changed<br/></div>";

}
$show_this = "change_current_pass";

?>