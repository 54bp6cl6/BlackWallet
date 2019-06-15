<?php
	require_once("library/func/cartClass.php");
	session_start();
	require_once("library/func/connMysql.php");
	require_once("library/func/func.php");
	if(!isset($_SESSION["account"])){
		header("Location: index.html");
	}
	$account = $_SESSION["account"];
	$result = $db_link->query("SELECT name FROM member WHERE account = '$account'");
	$row = $result->fetch_array();
	$name = $row[0];

	include("library/func/getMoney.php");

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$result = $db_link->query("SELECT * FROM transaction WHERE id = '$id'");
		if($result->num_rows <= 0){
			header("Location: transaction.php");
		}
		else{
			$row = $result->fetch_array();
			$name = $row['name'];
			$rate = $row['rate'];
			$avaNum = $row['avaNum'];
			$description = $row['description'];
			if($avaNum == -1) $avaNum = "無限";
		}
	}
	else{
		header("Location: transaction.php");
	}

	if(isset($_POST['count'])){
		$num = $_POST['count'];
		$cart =& $_SESSION['cart'];
		if(!is_object($cart)) $cart = new Cart();
		$cart->Add($id,$name,$rate,$num);
		header("Location: cartView.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>B$W 黑錢包 - 兌幣所</title>
	<link rel="icon" href="images/logo.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="library/css/wallet.css">
	<script src="library/func/func.js"></script>
</head>
<body onload="unfade(document.getElementById('main'))">
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
	<form name="buyForm" method="post" action="">
		<table class="info" id='main' align="center" style="margin-top: 100px;margin-bottom: 100px; border-spacing: 30px; border-radius: 30px;padding-left: 15%;font-size: 30px;">
			<tr><td style="font-size: 50px;"><?php echo $name ?></td></tr>
			<tr><td>匯率</td><td>1 : <?php echo $rate ?></td></tr>
			<tr><td>介紹</td><td><?php echo $description ?></td></tr>
			<tr><td>可兌換數量</td><td><?php echo $avaNum ?></td></tr>
			<tr><td>兌換數量</td><td><input class="textbox" type="number" name="count"></td></tr>
			<tr><td colspan="2"></td><td class="button" onclick="buyForm.submit();" style="width: 250px;">加入購物車</td></tr>
		</table>
	</form>
	<?php include("library/func/getBottom.php"); ?>
</body>
</html>
<?php $db_link->close(); ?>