<?php
	session_start();
	if(!isset($_SESSION["account"])){
		header("Location: index.html");
	}
	require_once("library/func/connMysql.php");
	$account = $_SESSION["account"];
	$result = $db_link->query("SELECT name FROM member WHERE account = '$account'");
	$row = $result->fetch_array();
	$name = $row[0];

	include("library/func/getMoney.php");

	$db_link->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>B$W 黑錢包 - 交易</title>
	<link rel="icon" href="images/logo.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="library/css/wallet.css">
	<script src="library/func/func.js"></script>
</head>
<body onload="unfade(document.getElementById('Pay-find'))">
	<?php include("library/func/getHeader.php"); ?>
	<table class="info" border="1">
		<tr>
			<td style="text-align: center;">暱稱</td>
			<td>&nbsp;<?php echo $name; ?></td>
			<td style="text-align: center;">帳號</td>
			<td>&nbsp;<?php echo $account; ?></td>
			<td style="text-align: center;">餘額</td>
			<td>&nbsp;<?php echo $money;?></td>
		</tr>
	</table>
	<div id="Pay-find">
		<form name="PayForm" class="payform" method="post" action="pay.php">
			<p align="center">輸入交易對象的帳號：<input class="textbox" type="text" name="Caccount"></p>
			<?php
				if(isset($_GET['find'])){
					if($_GET['find'] == 'true'){
						echo "<h5 align='center'>不能匯款給自己喔</h5>";
					}
					else{
						echo "<h5 align='center'>找不到這個帳號，請確認後再試</h5>";
					}
				}
				else{
					echo "<h5 style='visibility:hidden;'>空白</h5>";
				}
			?>
			<h2 class="button" style="margin-left: 35%; width: 30%; margin-top: 20px;" onclick="textbox_check('PayForm','Caccount')">搜尋</h2>
		</form>
	</div>
	<?php include("library/func/getBottom.php"); ?>
</body>
</html>