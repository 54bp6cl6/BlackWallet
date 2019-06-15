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

	include("library/func/getMoney.php");

	if(isset($_GET['count'])){
		$temp = $_GET['count'];
		$result = $db_link->query("SELECT * FROM record WHERE count = '$temp'");
		$row = $result->fetch_array();
		if($row['pay'] == $account){
			$result = $db_link->query("UPDATE record SET pcancel = '1' WHERE record.count = '$temp'");
			if($row['ccancel']){$result = $db_link->query("UPDATE record SET cancel = '1' WHERE record.count = '$temp'");}
		}
		else if ($row['collect'] == $account) {
			$result = $db_link->query("UPDATE record SET ccancel = '1' WHERE record.count = '$temp'");
			if($row['pcancel']){$result = $db_link->query("UPDATE record SET cancel = '1' WHERE record.count = '$temp'");}
		}
		header("Location: record.php");
	}

	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>B$W 黑錢包 - 交易紀錄</title>
	<link rel="icon" href="images/logo.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="library/css/wallet.css">
	<script src="library/func/func.js"></script>
</head>
<body onload="unfade(document.getElementById('all'))">
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
	<div id="all">
		<form method="get" action="" name="filter">
			<table class="recordTable">
				<tr>
					<td style="width: 10%;"></td>
					<td>篩選：
						<select name="side" style="font-size: 15px;padding: 5px;">
							<option >請選擇</option>
							<option value="pay">匯款人</option>
							<option value="collect">收款人</option>
						</select>
					</td>
					<td>金額
						<input type="number" name="min" placeholder="min" style="width: 130px;height: 20px;padding-left: 5px;">~
						<input type="number" name="max" placeholder="max" style="width: 130px;height: 20px;padding-left: 5px;">
					</td>
					<td>日期
						<input type="date" name="date" style="font-size: 15px;width: 130px;height: 20px;padding-left: 5px;">
					</td>
					<td class="button" onclick="document.forms['filter'].submit()">
						篩選
					</td>
					<td style="width: 10%;"></td>
				</tr>
			</table>
		</form>
		<table border="1" class="recordTable">
			<tr><td>交易日期</td><td>匯款人</td><td>收款人</td><td>交易金額</td><td>匯款人欲取消</td><td>收款人欲取消</td></tr>
			<?php
				$add = '';
				$qadd = '';
				$qaddDate = '';
				if(isset($_GET['min']) && $_GET['min']!=''){
					$qadd.=" AND dollar >= ".$_GET['min'];
					$add.='min='.$_GET['min'].'&';
				}
				if(isset($_GET['max']) && $_GET['max']!=''){
					$qadd.=" AND dollar <= ".$_GET['max'];
					$add.='max='.$_GET['max'].'&';
				}
				if(isset($_GET['date']) && $_GET['date'] != ''){
					$data = $_GET['date'];
					$qaddDate = " AND date = '$data'";
					$add.='date='.$_GET['date'].'&';
				}
				if(isset($_GET['side'])){
					$add.='side='.$_GET['side'].'&';
					if($_GET['side']=='pay'){
						$result = $db_link->query("SELECT * FROM record WHERE pay != 'sys' AND (pay = '$account'".$qadd.")$qaddDate ORDER BY count DESC");
					}
					elseif ($_GET['side']=='collect') {
						$result = $db_link->query("SELECT * FROM record WHERE pay != 'sys' AND (collect = '$account'".$qadd.")$qaddDate ORDER BY count DESC");
					}
					else{
						$result = $db_link->query("SELECT * FROM record WHERE pay != 'sys' AND ((pay = '$account' OR collect = '$account')".$qadd.")$qaddDate ORDER BY count DESC");
					}
				}
				else{
					$result = $db_link->query("SELECT * FROM record WHERE pay != 'sys' AND (pay = '$account' OR collect = '$account') ORDER BY count DESC");
				}
				$totleRow = $result->num_rows; //總行數
				$pageRow = 10; //每頁行數
				if($totleRow%$pageRow==0){
					$total_pages = $totleRow/$pageRow;
				}
				else{
					$total_pages = $totleRow/$pageRow+1;
				}
				$i = 0;
				while ($row = $result->fetch_array()) {
					if($i<($page-1)*$pageRow){
						$i++;
						continue;
					}
					elseif ($i==($page-1)*$pageRow+10) {
						break;
					}
					$i++;
				?>
					<tr>
						<td><?php 
							echo $row['date']; 
							?></td>
						<td><?php 
							if($row['pay'] == $account) echo "<font style='font-weight: bold;'>".$row['pay']."</font>";
							else echo $row['pay']; 
							?></td>
						<td><?php 
							if($row['collect'] == $account) echo "<font style='font-weight: bold;'>".$row['collect']."</font>";
							elseif ($row['collect'] == "sys") { echo "兌幣系統";}
							else echo $row['collect']; 
							?></td>
						<td><?php echo $row['dollar']; ?></td>
						<td>
							<?php
							if($row['pcancel']){echo "<font style='color:red';>是</font>";}
							else{echo "否";}
							?>
						</td>
						<td>
							<?php
							if($row['ccancel']){echo "<font style='color:red';>是</font>";}
							else{echo "否";}
							?>
						</td>
						<?php
						if (!$row['cancel']) {
							if($row['pay']==$account && !$row['pcancel']){
								$count = $row['count'];
								echo "<td class='button' style='font-size:20px;' onclick=location.href='record.php?count=$count'>取消</td>";
							}
							else if($row['collect']==$account && !$row['ccancel']){
								$count = $row['count'];
								echo "<td class='button' style='font-size:20px;' onclick=location.href='record.php?count=$count'>取消</td>";
							}
						}
						?>
					</tr>

				<?php
				}
				$db_link->close();
			?>
		</table>
		<?php GoToPage($page, (int)$total_pages,"record.php?".$add."page="); ?>
	</div>
	<?php include("library/func/getBottom.php"); ?>
</body>
</html>