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
		$result = $db_link->query("SELECT * FROM member WHERE account = '$account'");
		if($result->num_rows == 0){
			//帳號錯誤
			alert("輸入帳號有誤!!!");
		}
		else{
			while($row = $result->fetch_array()){
				if($row["password"] == $password){
					$_SESSION["account"] = $account;
					alert("登入成功");
					header("Location: wallet.php");
					break;
				}
				else{
					alert("輸入密碼有誤!!!");
				}
			}
		}
		$db_link->close();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>B$W - Login</title>
	<link rel="icon" href="images/logo.ico" type="image/x-icon">
	<script src="library/func/func.js"></script>
	<link rel="stylesheet" type="text/css" href="library/css/main.css">
</head>
<body onload="unfade(document.getElementById('All'))">
	<form name="LoginForm" method="post" action="">
		<table id="All" align="center">
			<tr>
				<td class="logo" onclick="location.href='index.html'">
					B$W<br><font style="font-size: 20px;font-family: Microsoft JhengHei;">黑錢包虛擬貨幣</font>
				</td>
				<td>
					<table id="FormTable">
						<tr>
							<td colspan="2">
								<font style="font-size: 40px; font-family: Microsoft JhengHei; font-weight: bold;">登入</font>
								<font style="font-size: 20px; font-weight: bold;">Login</font>
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
							<td id="Login" class="button" colspan="2" onclick="Login_check()">登入</td>
						</td>
					</table>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>