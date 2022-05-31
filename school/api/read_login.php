<?php

//header
header('Access-Control-Allow-Origin: * ');
header('Content-Type: application/json');

// initialize the api
include_once( '../core/initialize.php' );

// instantiate student
$login = new Login($db);

// student query
$result = $login->read_all();
//get row count
$num = $result->rowCount();

if( $num > 0 ){
    $login_arr = array();
    // $student_arr['data'] = array();

    while( $row = $result->fetch(PDO::FETCH_ASSOC) ){
        extract( $row );
        $users = array(
            'reg_num' => $reg_num,
            'uname' => $uname,
            'level' => $level
        );
        // array_push( $student_arr['data'], $students );
        array_push( $login_arr, $users );
    }
    //convert to jason then output
    echo json_encode( $login_arr );
    // echo json_encode( $student_arr[0]['fname'] );
}else{
    echo json_encode( array('message' => 'no student found') );
}


?>