<?php
	$con = mysql_connect("localhost","root","usbw") or die ("Não foi possível se conectar!");
	mysql_select_db("economize") or die("Não foi possível acessar ao banco!");
	mysql_set_charset("UTF8", $con);

?>		