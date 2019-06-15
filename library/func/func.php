<?php
	function alert($str)
	{
		echo "<script>alert('$str');</script>";
	}

function GoToPage($page, $total_pages,$path)
{
	//產生導覽列
	echo "<p align='center'>";

	if ($page > 1)
		echo "<a href='$path". ($page - 1) . "'>上一頁</a> ";

	for ($j = 1; $j <= $total_pages; $j++)
	{
		if ($j == $page)
			echo "$j ";
		else
			echo "<a href='$path$j'>$j</a> ";
	}

	if ($page < $total_pages)
		echo "<a href='$path". ($page + 1) . "'>下一頁</a> ";
	echo "</p>";
}
?>