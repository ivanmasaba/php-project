<?php

//header
header('Access-Control-Allow-Origin: * ');// allow any one 
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE ');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

// initialize the api
include_once( '../core/initialize.php' );

// instantiate student object
$student = new Student($db);

// get the raw create data
$data = json_decode( file_get_contents( "php://input" ) );

//put data into class variables
$student->reg_num = $data->reg_num;

//insert into db
if( $student->delete() ){
    //return true
    echo json_encode(
        array( 'message' => 'Student deleted' )
    );
}else{
    echo json_encode(
        array( 'message' => 'Student not delete' )
    );
}




?>