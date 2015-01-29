<?php
// $server_name = 'localhost';
// $username = 'root';
// $password = 'kxf890520';
// $db_name = 'test';

// $mysqli = new mysqli( $server_name, $username, $password, $db_name );

$path = $argv[1];
$handle = fopen( $path, 'r' );

$post = array('content' => array());
while ($line = fgets($handle)) {
    $line = trim( $line );
    if( empty($line ))
        continue;

    if( start_with( $line, 'title:' ))
    {
        $post['title'] = substr($line, 6);
        continue;
    }

    if( start_with( $line, 'author:'))
    {
        $post['author']  = substr($line, 7);
        continue;
    }


}


function start_with( $line, $pre )
{
    $length = strlen($pre);
    $line_pre = substr($line, 0, $length);
    if( $line_pre === $pre )
        return True;
    return False;
}






?>