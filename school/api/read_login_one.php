<?php

//header
header('Access-Control-Allow-Origin: * ');
header('Content-Type: application/json');

// initialize the api
include_once( '../core/initialize.php' );

// instantiate student object
$login = new Login($db);

// get the reg_num from the url using GET method
// check if it exist if not die() or end
$login->uname = isset($_GET['u']) ? $_GET['u'] : die()  ;
$login->password = isset($_GET['p']) ? $_GET['p'] : die()  ;
//call the read one method
$login->read_one();

//create an array and insert these values from read-one()
$user_array = array(
    'reg_num' => $login->reg_num,
    'uname' => $login->uname,
    'level' => $login->level
);

//convert to json and then display 
 print_r( json_encode( $user_array ) );


?>