<?php 


if(isset($_GET['name']) && isset($_GET['pw']))
{
	function FlushPrint($MysqlString)
	{
		  echo $MysqlString;
		  ob_flush();	
		  flush();
	}
	
	$MysqlStatePrint = array();

	$MysqlStatePrint['GETinformation'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;] &emsp; GET DATA information...';

	$MysqlConnectUserName = $_GET['name'];

	$MysqlStatePrint['Mysqlname'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;]&emsp;Receiving UserName information...';

	$MysqlConnectUserPassWord = $_GET['pw'];

	$MysqlStatePrint['MysqlPassWord'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;]  &emsp;Receiving PassWord information...';

	$MysqlConnectUserHost = "localhost";

	$MysqlStatePrint['MysqlHost'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;]&emsp;  Receiving Mysql Host information...';

	$MysqlConnectUserdb = "";

	$MysqlConnect = new mysqli($MysqlConnectUserHost , $MysqlConnectUserName , $MysqlConnectUserPassWord);

	$MysqlStatePrint['MysqlDataBase'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;] &emsp; Connecting to database...';

	$MysqlConnect->set_charset("utf8");

	$MysqlStatePrint['Mysqlutf8'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;] &emsp; Setting mysql encoding...';

	$MysqlDataBaseInsert = "CREATE DATABASE IF NOT EXISTS what2020";

	$MysqlStatePrint['stringdb'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;] &emsp; what2020 data table add syntax generated
';

	$MysqlDataBaseQuery = $MysqlConnect->query($MysqlDataBaseInsert);

	$MysqlStatePrint['MysqlDataBase'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;]  &emsp;Creating what2020 database...';

	mysqli_select_db($MysqlConnect, "what2020");

	$MysqlTable = "CREATE TABLE IF NOT EXISTS webuserconnect (web varchar(100) NOT NULL, Connect bigint(255) NOT NULL)";

	$MysqlStatePrint['stringtable'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;] &emsp; Creating webuserconnect table and creating column attribute statement';

	$MysqlTableproduce = $MysqlConnect->query($MysqlTable);

	$MysqlStatePrint['Mysqltable'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;] &emsp; Creating webuserconnect table....';

	$MysqlSolumninsert = "INSERT INTO webuserconnect (web,Connect) values('web',1)";

	$MysqlStatePrint['stringvalue'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;] &emsp; Create a syntax for adding data to the webuserconnect table';

	$MysqlInsertData = $MysqlConnect->query($MysqlSolumninsert);

	$MysqlStatePrint['Mysqltableinsertdata'] = '[&emsp;<string style=\'color:#00751f;\'>OK</string>&emsp;] &emsp; Adding webuserconnect table data...';

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>mysql insert</title>
</head>
<body style="background: black;color:#fff;font-size: 16px;">
	<?php 
		if(isset($_GET['name']) && isset($_GET['pw'])){
			foreach ($MysqlStatePrint as $key => $value) {
			  FlushPrint($value."<br><br>");
			  usleep(100000);
		}
		}
	
	else{
	echo "[&emsp;<string style='color:#00751f;'>NO</string>&emsp;]&emsp;not GET data!!";
	}
	?>
</body>
</html>
<?php 

?>