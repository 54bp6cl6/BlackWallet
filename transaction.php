<?php
	session_start();
	if(!isset($_SESSION["account"])){
		header("Location: index.html");
	}
	require_once("library/func/connMysql.php");
	require_once("library/func/func.php");
	$account = $_SESSION["account"];
	$result = $db_link->query("SELECT name FROM member WHERE account = '$account'");
	$row = $result->fetch_array();
	$name = $row[0];

	if(isset($_POST['bwd']) && $_POST['bwd']>0){
		$bwd = $_POST['bwd'];
		$result = $db_link->query("INSERT INTO record (pay, collect, dollar, count) VALUES ('sys', '$account', '$bwd', NULL)");
		alert("你購買了 黑錢幣 $bwd 枚，共計 $bwd 元");
	}

	include("library/func/getMoney.php");
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
	<div id="main">
		<form name="twdForm" method="post" action="">
			<table class="seleTable" border="0">
				<caption>買入</caption>
				<tr><td style="width: 150px;">可買入的幣種：</td><td>台幣匯率</td><td style="width: 100px;">買入數量</td></tr>
				<tr><td>黑錢幣</td><td>1 : 1</td><td><input type="number" name="bwd" value="0"></td><td style="width: 20px;"></td><td class="button" onclick="twdForm.submit();" style="width: 150px;">立刻購買</td></tr>
			</table>
		</form>
		<table class="seleTable" border="0">
			<caption>賣出</caption>
			<tr><td style="width: 200px;">可兌換的幣種：</td><td>匯率</td><td>可購入數量</td></tr>
			<?php
				$result = $db_link->query("SELECT * FROM transaction");
				while ($row = $result->fetch_array()) {
					?>
					<tr><td><?php echo $row["name"] ?></td><td>1 : <?php echo $row['rate'] ?></td>
						<td>
							<?php if ($row['avaNum'] == -1) {
								echo '無限';
							} else echo $row['avaNum']; ?>
						</td>
						<td class="button" onclick="location.href='buy.php?id=<?php echo $row['id'] ?>'">兌換</td></tr>
					<?php
				}
			?>
		</table>
		<table align="center" style="padding-top: 30px;margin-bottom: 200px;">
			<tr>
				<td class="button" style="padding-left: 20px;padding-right: 20px;" onclick="location.href='cartView.php'">查看購物車</td>
			</tr>
		</table>
	</div>
	<?php include("library/func/getBottom.php"); ?>
</body>
</html>
<?php $db_link->close(); ?>