<?php

//header
header('Access-Control-Allow-Origin: * ');// allow any one 
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

// initialize the api
include_once( '../../core/initialize.php' );

// instantiate student object
$student = new Student($db);

// get the raw create data
$data = json_decode( file_get_contents( "php://input" ) );

//put data into class variables
$student->reg_num = $data->reg_num;
$student->fname = $data->fname;
$student->lname = $data->lname;
$student->class_id = $data->class_id;
$student->class_name = $data->class_name;
$student->birth_date = $data->birth_date;
$student->father_name = $data->father_name;
$student->mother_name = $data->mother_name;
$student->parent_phone = $data->parent_phone;
$student->parent_address = $data->parent_address;

//insert into db
if( $student->create() ){
    //return true
    echo json_encode(
        array( 'message' => 'Student created' )
    );
}else{
    echo json_encode(
        array( 'message' => 'Student no created' )
    );
}




?>