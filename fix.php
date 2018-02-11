

<?php

//*
//
//This file copies order statuses from _history 
//of version 4 to ps_orders field: current_status of newer version 1.6
//By @netplayer
//
*//

//error_reporting(0);


//connect to DB
if (!$link = mysql_connect('localhost', 'root', '')) {
    echo 'Could not connect to mysql';
    exit;
}

if (!mysql_select_db('1518284363-773b29e4', $link)) {
    echo 'Could not select database';
    exit;
}

//Create the array of orders ($orders[])
$sql    = 'SELECT * FROM ps_orders ORDER BY id_order ASC';
$result = mysql_query($sql, $link);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) {
    
	$orders[]=$row['id_order'];

}


//Create the array of statuses from status history ($history[])
	foreach($orders as $order){
	
$q="SELECT MAX(id_order_history) AS max_history FROM `ps_order_history` WHERE `id_order`=".$order." ORDER BY id_order ASC";	
$res = mysql_query($q, $link);

if (!$res) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($r = mysql_fetch_assoc($res)) {
  
  
  $nu="SELECT `id_order_state` as status_id FROM `ps_order_history` WHERE `id_order_history`=".$r['max_history'];
  $rnum=mysql_query($nu,$link);
  while($c=mysql_fetch_assoc($rnum)){
  $history[]=$c['status_id'];
  }
}
 }
 

 //Update ps_orders table , current_state field with latest history status
 for($i=0;$i< count($history);$i++){
	
	$x="UPDATE `ps_orders` SET current_state=".$history[$i]." WHERE `id_order`= ".$orders[$i];
	$final= mysql_query($x, $link);
	
	if (!$final) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
	//output the order/status pair 
	 echo $history[$i].'-->  '.$orders[$i].'<br/>';;
 }


 
 
mysql_free_result($result);

?>