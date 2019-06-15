<?php
	session_start();
	if(isset($_SESSION["account"])){
		header("Location: wallet.php");
	}
	if(isset($_POST["account"])){
		require_once("library/func/connMysql.php");
		require_once("library/func/func.php");
		$account = $_POST["account"];
		$password = $_POST["password"];
		$name = $_POST["name"];

		$result = $db_link->query("SELECT account FROM member WHERE account = '$account'");
		if($result->num_rows == 0){
			//寫入註冊資料
			$db_link->query("INSERT INTO member (account, password, name) VALUES ('$account', '$password', '$name')");
			$db_link->query("INSERT INTO record (pay, collect, dollar, count) VALUES ('sys', '$account', '500', NULL)");
			$_SESSION["account"] = $account;
			header("Location: wallet.php");
		}
		else{
			alert("這個帳號已經被人註冊囉，換一個吧!");
		}
		$db_link->close();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>B$W - Sign Up</title>
	<link rel="icon" href="images/logo.ico" type="image/x-icon">
	<script src="library/func/func.js"></script>
	<link rel="stylesheet" type="text/css" href="library/css/main.css">
</head>
<body onload="unfade(document.getElementById('All'))">
	<form name="SignUpForm" method="post" action="">
		<table id="All" align="center">
			<tr>
				<td class="logo" onclick="location.href='index.html'">
					B$W<br><font style="font-size: 20px;font-family: Microsoft JhengHei;">黑錢包虛擬貨幣</font>
				</td>
				<td>
					<table id="FormTable">
						<tr>
							<td colspan="2">
								<font style="font-size: 40px; font-family: Microsoft JhengHei; font-weight: bold;">註冊</font>
								<font style="font-size: 20px; font-weight: bold;">Sign Up</font>
							</td>
						</tr>
						<tr>
							<td class="lable">帳號</td>
							<td><input type="text" name="account" class="textBox" placeholder="6~20字"></td>
						</tr>
						<tr>
							<td class="lable">密碼</td>
							<td><input type="password" name="password" class="textBox" placeholder="6~20字"></td>
						</tr>
						<tr>
							<td class="lable">密碼確認</td>
							<td><input type="password" name="repassword" class="textBox" placeholder="與密碼相同"></td>
						</tr>
						<tr>
							<td class="lable">暱稱</td>
							<td><input type="text" name="name" class="textBox" placeholder="最多20字"></td>
						</tr>
						<tr>
							<td id="Login" class="button" colspan="2" onclick="SignUp_check()">註冊</td>
						</td>
					</table>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>