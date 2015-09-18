<?php

include 'autoload.php';
set_time_limit(0);
$last_counter = isset($_GET['passcounter']) ? (int)$_GET['passcounter'] : null;
$users_dao->long_pooling($last_counter);
// while (true) {		   
//     $last_counter = isset($_GET['passcounter']) ? (int)$_GET['passcounter'] : null;
//     $last_change_counter = $users_dao->getCount();

//     if ($last_counter == null || $last_change_counter > $last_counter) {

//     	if($last_change_counter == 0){

//     		sleep( 1 );
//     		continue;

//     	}else{

//     		$result = array('passcounter' => $last_change_counter);
    		
//     		$json = json_encode($result);
//     		echo $json;		 
//     		break;

//     	}			        	

//     } else {		

//         sleep( 1 );
//         continue;

//     }
// }

?>