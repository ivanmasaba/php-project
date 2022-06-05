<?php

//header
header('Access-Control-Allow-Origin: * ');
header('Content-Type: application/json');

// initialize the api
include_once( '../../core/initialize.php' );

// instantiate student object
$student = new Student($db);

// get the reg_num from the url using GET method
// check if it exist if not die() or end
$student->reg_num = isset($_GET['reg_num']) ? $_GET['reg_num'] : die()  ;
//call the read one method
$student->read_one();

//create an array and insert these values from read-one()
$student_array = array(
    'reg_num' => $student->reg_num,
    'fname' => $student->fname,
    'lname' => $student->lname,
    'class_id' => $student->class_id,
    'class_name' => $student->class_name,
    'birth_date' => $student->birth_date,
    'father_name' => $student->father_name,
    'mother_name' => $student->mother_name,
    'parent_phone' => $student->parent_phone,
    'parent_address' => $student->parent_address
);

//convert to json and then display 
 print_r( json_encode( $student_array ) );


?>