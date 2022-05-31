<?php

//header
header('Access-Control-Allow-Origin: * ');
header('Content-Type: application/json');

// initialize the api
include_once( '../core/initialize.php' );

// instantiate student
$mark = new Marks($db);

// $mark->reg_num = isset($_GET['r']) ? $_GET['r'] : die()  ;

// student query
$result = $mark->read_one(1);
//get row count
$num = $result->rowCount();

if( $num > 0 ){
    $marks_arr = array();
    // $marks_arr['data'] = array();

    while( $row = $result->fetch(PDO::FETCH_ASSOC) ){
        extract( $row );
        $students = array(
            'reg_num' => $reg_num,
            'subject_id' => $subj_id,
            'subject_name' => $subj_name,
            'test_score' => $test_score,
            'exam_score' => $exam_score,
            'total_score' => $total_score,
            'grade' => $grade
        );
        // array_push( $marks_arr['data'], $students );
        array_push( $marks_arr, $students );
    }
    //convert to jason then output
    echo json_encode( $marks_arr );
    // echo json_encode( $marks_arr[0]['fname'] );
}else{
    echo json_encode( array('message' => 'no marks found') );
}


?>