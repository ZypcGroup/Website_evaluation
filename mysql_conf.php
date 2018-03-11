<?php

$host = '';
$user = '';
$psd = '';

if(mysql_connect($host,$user,$psd)){
	mysql_select_db('wzpb');
	mysql_query("set names 'utf8'");
}else{
	echo "<script>alert('服务器正在维护')</script>";
}


