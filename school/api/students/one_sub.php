<?php

//header
header('Access-Control-Allow-Origin: * ');
header('Content-Type: application/json');

// initialize the api
include_once( '../../core/initialize.php' );

// instantiate student object
$mark = new Staff($db);

// get the reg_num, class name, subject from the url using GET method
// check if it exist if not die() or end
$reg = isset($_GET['reg']) ? $_GET['reg'] : die()  ;
$cname = isset($_GET['cname']) ? $_GET['cname'] : die()  ;
$sub = isset($_GET['sub']) ? $_GET['sub'] : die()  ;
//call the read one method
$result = $mark->read_os( $reg, $cname, $sub );

//get row count
$num = $result->rowCount();

if( $num > 0 ){
    $arr = array();
    // $student_arr['data'] = array();

    while( $row = $result->fetch(PDO::FETCH_ASSOC) ){
        extract( $row );
        $students = array(
            'test' => $test_score,
            'exam' => $exam_score,
            'total' => $total_score,
            'grade' => $grade,
        );
        // array_push( $arr['data'], $students );
        array_push( $arr, $students );
    }
    //convert to jason then output
    echo json_encode( $arr );
    // echo json_encode( $arr[0]['fname'] );
}else{
    echo json_encode( array('message' => 'no student found') );
}

?>