<?php
	require_once("library/func/cartClass.php");
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

	include("library/func/getMoney.php");

	$cart =& $_SESSION['cart'];
	if(!is_object($cart)) $cart = new Cart();

	if(isset($_POST['updateid'])){
		$i = 0;
		foreach ($cart->items as $key => $value) {
			$cart->Edit($key,$_POST['updateid'][$i]);
			$i++;
		}
	}
	else{
		if(isset($_GET['command']) && $_GET['command'] == "clear"){
			$cart->Clear();
		}

		if(isset($_GET['command']) && $_GET['command'] == "check"){
			if($cart->getTotal() > $money){
				alert("帳戶餘額不足，請調整兌換數量");
			}
			else{
				foreach ($cart->items as $key => $value) {
					if($value->num > 0){
						$result = $db_link->query("SELECT avaNum FROM transaction WHERE id = '$key'");
						$num = $result->fetch_array();
						if($num[0]!=-1){
							if($num[0]<$value->num){
								alert($value->name."兌換數量超過限制(".$num[0].")，請修改");
							}
							else{
								$num = $num[0] - $value->num;
								$result = $db_link->query("UPDATE transaction SET avaNum = '$num' WHERE id = $key");
								$temp = $cart->getTotal();
								$result = $db_link->query("INSERT INTO record (pay, collect, dollar, count) VALUES ('$account', 'sys', '$temp', NULL)");
								$cart->Clear();
								alert("我們會盡快將款項匯入您指定的帳戶，兌幣期間請耐心等候~");
							}
						}
					}
				}
				
			}
		}
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
		<form name="updateForm" method="post" action="">
			<table class="seleTable" border="0">
				<caption>購物車</caption>
				<tr><td style="width: 200px;">兌換幣種：</td><td>匯率</td><td>數量</td></tr>
				<?php
					foreach ($cart->items as $key => $value) {
						if($value->num > 0){
							?>
							<tr><td><?php echo $value->name ?></td><td>1 : <?php echo $value->rate ?></td>
								<td><input type="number" name="updateid[]" value="<?php echo $value->num ?>" style="width: 200px;"></td></tr>
							<?php
						}
					}
				?>
				<tr><td>總金額</td><td><?php echo $cart->getTotal() ?></td></tr>
			</table>
			<table align="center" style="padding-top: 30px;margin-bottom: 200px;border-spacing: 10px;">
				<tr>
					<td class="button" style="padding-left: 20px;padding-right: 20px;" onclick="updateForm.submit()">更新購物車</td>
					<td class="button" style="padding-left: 20px;padding-right: 20px;" onclick="location.href='cartView.php?command=clear'">清空購物車</td>
					<td class="button" style="padding-left: 20px;padding-right: 20px;" onclick="location.href='cartView.php?command=check'">結帳</td>
					<td class="button" style="padding-left: 20px;padding-right: 20px;" onclick="location.href='transaction.php'">回兌幣所</td>
				</tr>
			</table>
		</form>
	</div>
	<?php include("library/func/getBottom.php"); ?>
</body>
</html>
<?php $db_link->close(); ?>