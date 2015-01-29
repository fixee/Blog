<?php

$dir_path = 'image_crawl/';

$server_name = 'localhost';
$username = 'root';
$password = 'kxf890520';
$db_name = 'test';

$mysqli = new mysqli( $server_name, $username, $password, $db_name );

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$query = 'insert into blog_image( filename, image ) values( ?, ? )';
$stmt = $mysqli->prepare( $query );
$stmt->bind_param("ss", $file_name, $content );

for($i = 0; $i <= 5730; $i++ )
{    
    $file_name = '' . $i . '.jpg';
    $file_path = $dir_path . $file_name;
    $handle = fopen( $file_path, 'rb' );
    $content = fread($handle, filesize($file_path));
    fclose($handle);

    $stmt->execute();
    echo $file_name, PHP_EOL;
}



?>