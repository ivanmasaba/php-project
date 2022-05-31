<?php
	$tab1='tabs_active'; 
    $tab2='tabs';
    $current_user_type = 'new';
    $error_fill = 0;
    $new_form_msg = "<div class='info' >";
    
    $fname = $fname;
    $lname = $_POST['lname'];
    $index_number = $index_number;
    $class = $_POST['class'];
    $gender = $_POST['gender'];
$birth_date = date('Y-m-d', strtotime($_POST['birth_date']));
    $father_name = $_POST['fathers_name'];
    $mother_name = $_POST['mothers_name'];
    $parent_phone = $_POST['parent_phone'];
    $parent_address = $_POST['parent_address'];

    $reg_type = 'new student';
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

              $student->reg_num        =  $index_number ;
        $student->fname          =  $fname ;
        $student->lname          =  $lname ;
        $student->class_id       =  $class ;
        $student->gender         =  $gender ;
        $student->birth_date     =  $birth_date ;
        $student->father_name    =  $father_name ;
        $student->mother_name    =  $mother_name ;
        $student->parent_phone   =  $parent_phone ;
        $student->parent_address =  $parent_address ;
    
        $student->create();


                
                        $new_form_msg .= "Thank you for taking time to register";
                    }
                    else{
                        $new_form_msg .= " Registration failed. ".$cxn->error;
                     }
            
    
    $new_form_msg .= "</div>";
    
    ?>