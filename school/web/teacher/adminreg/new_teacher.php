<?php
	$tab1='tabs_active'; 
    $tab2='tabs';
    $current_user_type = 'new';
    $error_fill = 0;
    $new_form_msg = "<div class='info' >";
    
    $fname = $current_user;
    $lname = $_POST['lname'];
    $staff_id = $staff_id;
    $class_id = $_POST['class'];
    $subj_id = $_POST['subject'];
    $gender = $_POST['gender'];
    $birth_date = date('Y-m-d', strtotime($_POST['birth_date']));
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $reg_type = 'new teacher';
    //check for empty fields
    foreach( $_POST as $field => $value )
    {
        if ( $value == "")
        {
            $new_form_msg .= "Some fields are empty.";
        }
    }
            
    //enter them into the database
    // if no errors, enter values into the database
    if ( $error_fill == 0 )
    {

        $teacher->staff_id    =  $staff_id ;
        $teacher->class_id    =  $class_id ;
        $teacher->subj_id     =  $subj_id ;
        $teacher->fname       =  $fname ;
        $teacher->lname       =  $lname ;
        $teacher->gender      =  $gender ;
        $teacher->birth_date  =  $birth_date ;
        $teacher->email       =  $email ;
        $teacher->phone       =  $phone ;
        $teacher->address     =  $address ;
    
        $teacher->create();


                
                        $new_form_msg .= "Thank you for taking time to register";
                    }
                    else{
                        $new_form_msg .= " Registration failed. ";
                     }
            
    
    $new_form_msg .= "</div>";
    
    ?>