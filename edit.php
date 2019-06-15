<?php
	session_start();
	if(!isset($_SESSION["account"])){
		header("Location: index.html");
	}
	require_once("library/func/connMysql.php");
	require_once("library/func/func.php");
	$account = $_SESSION["account"];
	$result = $db_link->query("SELECT * FROM member WHERE account = '$account'");
	$row = $result->fetch_array();
	$name = $row['name'];
	$imgPath = $row['img'];
	$message = $row['message'];

	include("library/func/getMoney.php");

	$changed = false;

	if(isset($_POST['name']) && $_POST['name'] != ""){
		$changed = true;
		$name = $_POST['name'];
		$result = $db_link->query("UPDATE member SET name = '$name' WHERE member.account = '$account'");
	}

	if(isset($_POST['message']) && $_POST['message'] != ""){
		$changed = true;
		$message = $_POST['message'];
		$result = $db_link->query("UPDATE member SET message = '$message' WHERE member.account = '$account'");
	}

	if(isset($_FILES["img"])){
		if($_FILES["img"]["name"] != ""){
			move_uploaded_file($_FILES["img"]["tmp_name"], "./pic/".$_FILES["img"]["name"]);
			$changed = true;
			$imgPath = $_FILES["img"]["name"];
			$result = $db_link->query("UPDATE member SET img = '$imgPath' WHERE member.account = '$account'");
		}
	}

	if($changed){
		header("Location: myAccount.php");
	}

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
<body onload="unfade(document.getElementById('edit'))">
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
	<form name="edit" id="edit" method="post" action="" enctype="multipart/form-data">
		<table class="info" align="center" style="margin-top: 100px;margin-bottom: 100px;border-spacing: 30px;border-radius: 30px;">
			<tr>
				<td width="200" rowspan="2"><img style=" width: 200px;" src="<?php 
				if($imgPath===""){
					echo 'images/defaultHead.jpg';
				}
				else{
					echo 'pic/'.$imgPath;
				} ?>"><br><input type="hidden" name="MAX_FILE_SIZE" value="10263370">
					<input type="file" name="img" accept="image/*" size="50"></td>
				<td align="right" height="50"><h2>暱稱</h2></td>
				<td><input class="textbox" type="text" name="name"  value="<?php echo $name; ?>"></td>
			</tr>
			<tr>
				<td align="right"><h2>個性簽名</h2></td>
				<td><textarea form="edit" cols="50" rows="5" style="font-size: 25px;" name="message"><?php echo $message; ?></textarea></td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td class="button" height="50" width="100" onclick="document.forms['edit'].submit()">儲存</td>
			</tr>
		</table>
	</form>
	<?php include("library/func/getBottom.php"); ?>
</body>
</html>