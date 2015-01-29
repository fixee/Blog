<?php
// $server_name = 'localhost';
// $username = 'root';
// $password = 'kxf890520';
// $db_name = 'test';

// $mysqli = new mysqli( $server_name, $username, $password, $db_name );

$path = $argv[1];
$handle = fopen( $path, 'r' );

$iter_status = array( 'description', 'title', 'subtitle', 'image', 'content', 'code' );

$status = '';
$post = new Post();

while( $line = fgets( $handle ) )
{
	$line = trim( $line );
	if( empty( $line ) )
		continue;

	if( in_array( $line, $iter_status ) )
	{
		$status = $line;
		continue;
	}

	$post->readline( $status, $line );
}


class Post
{
	public $author;
	public $title;
	public $category;

	private $status;

	public $content = array();

	public function readline( $type, $line )
	{
	}
}





?>
