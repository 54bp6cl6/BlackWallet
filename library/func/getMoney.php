<?php
//撈錢
$money = 0;
$result = $db_link->query("SELECT * FROM record WHERE (pay = '$account' OR collect = '$account') AND cancel = 0 ");
while ($row = $result->fetch_array()) {
	if($row['pay'] == $account){
		$money -= $row['dollar'];
	}
	if ($row['collect'] == $account) {
		$money += $row['dollar'];
	}
}
?>