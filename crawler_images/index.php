<?php

header("Content-type: image/jpeg");

isset( $_GET['id'] ) and $id = $_GET['id'];
empty($id) and $id = 1;

$dir_path = 'image_crawl/';

$server_name = 'localhost';
$username = 'root';
$password = 'kxf890520';
$db_name = 'test';

$mysqli = new mysqli( $server_name, $username, $password, $db_name );

$query = 'select * from blog_image where id = ' . $id;
$result = $mysqli->query( $query );
$row = $result->fetch_array(MYSQLI_ASSOC);

echo $row['image'];

?>