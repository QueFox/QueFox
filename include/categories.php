<?php
	function GetCategoriesAsJson()
	{
		include 'db.php';
		
		$quotefishDB = mysql_connect($dbServer, $dbUserName, $dbPassword);
		if (!$quotefishDB)
		{
			die('Could not connect: ' . mysql_error());
		}
		$retrieveCategoryList = "SELECT CONCAT(s.Synonym, ' (',c.Name,')') From quotefish.Synonym s INNER JOIN quotefish.Category c on s.categoryId=c.Id;";
		$categories = mysql_query($retrieveCategoryList, $quotefishDB);
		if (!$categories)
		{
			die('Invalid query: ' . mysql_error());
		}
		$retVal = "[";
		while($row = mysql_fetch_array($categories))
		{
			$retVal = $retVal . '"' . $row[0] . '"' . ",";
		}				
		$retVal = substr($retVal, 0, strlen($retVal) - 1);
		$retVal = $retVal . "]";
		print $retVal;
		mysql_close($quotefishDB);
	}
?>
