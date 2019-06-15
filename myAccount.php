<?php
	session_start();
	if(!isset($_SESSION["account"])){
		header("Location: index.html");
	}
	require_once("library/func/connMysql.php");
	$account = $_SESSION["account"];
	$result = $db_link->query("SELECT * FROM member WHERE account = '$account'");
	$row = $result->fetch_array();
	$name = $row['name'];
	$imgPath = $row['img'];
	$message = $row['message'];

	include("library/func/getMoney.php");

	$db_link->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>B$W 黑錢包 - 個人資料</title>
	<link rel="icon" href="images/logo.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="library/css/wallet.css">
	<script src="library/func/func.js"></script>
</head>
<body onload="unfade(document.getElementById('message'))">
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
	<table class="info" id='message' align="center" style="margin-top: 100px;margin-bottom: 100px; border-spacing: 30px; border-radius: 30px;">
		<tr><td rowspan="2" width="250"><img style="width: auto;height: auto;max-width: 250px;max-height: 300px;" src="<?php 
			if($imgPath===""){
				echo 'images/defaultHead.jpg';
			}
			else{
				echo 'pic/'.$imgPath;
			} ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td style="font-size: 30px; width: 200px;">個性簽名：</td>
			<td style="font-size: 30px;">
				<?php 
					if($message === ""){
						echo "這個人很懶~什麼都沒有留下~";
					} 
					else{
						$temp =  preg_replace('/\n/',"<br>",$message);
						echo $temp;
					}
				?>
			</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="4"></td>
			<td class="button" height="50" width="100" onclick="location.href='edit.php'">編輯</td>
		</tr>
	</table>
	<?php include("library/func/getBottom.php"); ?>
</body>
</html>