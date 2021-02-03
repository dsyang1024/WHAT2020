<?php 

//SessIon Start
session_start();

$mysql = new mysqli("localhost","root","autoset","what2020");
//ᕕ( ᐛ )ᕗ
//new mysqli(Mysql host , Mysql User Name , Mysql User PassWd , Mysql Connect DataBases)

$mysql->set_charset("utf8");

if(!isset($_SESSION['UserConnect'])){

	//Not Web Connect
	$_SESSION['UserConnect'] = time();
	//SESSION if UserConnect Check

	$MySqlConnectQuery = 'UPDATE webuserconnect SET Connect = Connect + 1 where web = "web"';
	//update webuserconnect table Connect column add 1

	$ConnectResult = $mysql->query($MySqlConnectQuery);
	//query send

}
else{
	if($_SESSION['UserConnect'] + 60 * 60 <= time()){
	#SESSION = time() -> seconds 3600 or 60 * 60 <= time()


		unset($_SESSION['UserConnect']);
		#unset SESSION UserConnect name

	}
}
//User Connect funection -> webuserconnect Table select result return
function UserConnect(){

	global $mysql;
	//mysql global

	$SelectUser = "SELECT * FROM `webuserconnect` where web = 'web'";
	//webuserconnect Table SELECT 

	$Connect = $mysql->query($SelectUser);
	#Query send

	$UserWebConnectresult = $Connect->fetch_array();
	//query result -> array key

	return $UserWebConnectresult;
	//variable result return
}

?>