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

	if(isset($_POST['Caccount'])){
		$Caccount = $_POST['Caccount'];
		$Cname = "nop";
		$result = $db_link->query("SELECT * FROM member WHERE account = '$Caccount'");
		$row = $result->fetch_array();
		if ($result->num_rows < 1){
			header("Location: wallet.php?find=false");
		}
		elseif ($row['account'] == $account){
			header("Location: wallet.php?find=true");
		}
		else{
			$Cname = $row['name'];
			$CimgPath = $row['img'];
			$Cmessage = $row['message'];
		}
	}
	else{
		header("Location: wallet.php");
	}

	if(isset($_POST['pay_dollar'])){
		require_once("library/func/func.php");
		$pay = $_POST['pay_dollar'];
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y/m/d");
		$result = $db_link->query("INSERT INTO record (date, pay, collect, dollar, count) VALUES ('$date', '$account', '$Caccount', '$pay', NULL)");
		alert("交易成功!!!");
		header("Location: wallet.php");
	}

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
<body onload="unfade(document.getElementById('Pay'))">
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
	<div id="Pay" align="center">
		<form name="PayForm" class="payform2" method="post" action="">
			<input type="hidden" name="Caccount" value='<?php echo $Caccount ?>'>
			<table>
				<tr>
					<td rowspan="8"><img style="width: auto;height: auto;max-width: 500px;max-height: 600px;" src="<?php 
					if($CimgPath===""){
						echo 'images/defaultHead.jpg';
					}
					else{
						echo 'pic/'.$CimgPath;
					} ?>"></td>
					<td rowspan="8" width="30"></td>
					<td style="width: 200px;">匯款暱稱：</td><td><?php echo $Cname; ?></td>
				</tr>
				<tr>
					<td>匯款帳號：</td><td><?php echo $Caccount; ?></td>
				</tr>
				<tr>
					<td valign="top">個性簽名：</td><td style="font-size: 30px;">
						<?php 
							if($Cmessage === ""){
								echo "這個人很懶~什麼都沒有留下~";
							} 
							else{
								$temp =  preg_replace('/\n/',"<br>",$Cmessage);
								echo $temp;
							}
						?>
					</td>
				</tr>
				<tr>
					<td>你的餘額：</td><td id="money"><?php echo $money; ?></td>
				</tr>
				<tr>
					<td>匯款金額：</td><td><input class="textbox" type="number" min="1" name="pay_dollar"></td>
				</tr>
				<tr><td height="40"></td></tr>
				<tr><td colspan="2" class="button" onclick="pay_check()">匯款</td></tr>
			</table>
		</form>
	</div>
	<?php include("library/func/getBottom.php"); ?>
</body>
</html>