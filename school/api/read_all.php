<?php

//header
header('Access-Control-Allow-Origin: * ');
header('Content-Type: application/json');

// initialize the api
include_once( '../core/initialize.php' );

// instantiate student
$student = new Student($db);

// student query
$result = $student->read_all();
//get row count
$num = $result->rowCount();

if( $num > 0 ){
    $student_arr = array();
    // $student_arr['data'] = array();

    while( $row = $result->fetch(PDO::FETCH_ASSOC) ){
        extract( $row );
        $students = array(
            'reg_num' => $reg_num,
            'fname' => $fname,
            'lname' => $lname,
            'class_id' => $class_id,
            'class_name' => $class_name,
            'birth_date' => $birth_date,
            'father_name' => $father_name,
            'mother_name' => $mother_name,
            'parent_phone' => $parent_phone,
            'parent_address' => $parent_address
        );
        // array_push( $student_arr['data'], $students );
        array_push( $student_arr, $students );
    }
    //convert to jason then output
    echo json_encode( $student_arr );
    // echo json_encode( $student_arr[0]['fname'] );
}else{
    echo json_encode( array('message' => 'no student found') );
}


?>