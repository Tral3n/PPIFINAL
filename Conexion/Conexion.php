<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$db_host="us-cdbr-east-04.cleardb.com"; //localhost
$db_nombre="heroku_f7036baf347b6a5"; //primax
$db_usuario="be638dfe02bc87";//root
$db_pw="18c8a290";// ""
$db = substr($url["path"], 1);
$conexion=mysqli_connect($db_host,$db_usuario,$db_pw,$db_nombre);


?>