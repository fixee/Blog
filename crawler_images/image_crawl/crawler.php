<?php

$url_from = 'http://www.mm131.com/qingchun/list_1_';
$url_end = '.html';
$url_arr = array();
for( $i = 1; $i <= 27; $i++ )
{
    $url = $url_from . $i . $url_end;
    $url_arr[] = $url;
}

foreach ($url_arr as $url) {
    crawl_list( $url );    
}



function crawl_list( $url )
{
    $content = file_get_contents($url);
    $content = iconv('gb2312', 'utf-8//IGNORE', $content);

    $start_tag  = '"list-left public-box"';
    $end_tag = 'class="page"';
    $pos_start = strpos( $content, $start_tag );
    $pos_end = strpos( $content, $end_tag );
    $content = substr($content, $pos_start + strlen( $start_tag), $pos_end - $pos_start - strlen( $start_tag ) );

    $href_tag_start = 'href="';
    $href_tag_end = '"';

    $url_list = array();
    while ( ( $ret = strpos($content, '<dd>') ) !== False ) {
        $content = substr($content, $ret );


        $pos = strpos($content, $href_tag_start );
        $content = substr($content, $pos + strlen($href_tag_start) );
        $pos = strpos( $content, $href_tag_end );
        $url = substr( $content, 0, $pos );
        $url_list[] = $url;
    }

    if( !empty($url_list ) )
    {
        foreach ($url_list as $url) {
            $ret = get_image_urls( $url );
            foreach ($ret as $image_url) {
                save_image( $image_url );
            }
        }
        
    }
}

function get_image_urls( $image_page_url )
{
    $content = file_get_contents($image_page_url);
    $content = iconv('gb2312', 'utf-8//IGNORE', $content);

    $tag = '<span class="page-ch">共';
    $pos = strpos($content, $tag);
    $str = substr($content, $pos + strlen( $tag ), 10);
    $total = intval( $str );

    $pos = strrpos($image_page_url, '.');
    $url_from = substr($image_page_url, 0, $pos );
    $pos = strrpos($url_from, '/');
    $url_from = substr($url_from, $pos + 1);
    $url_from = 'http://img1.mm131.com/pic/' . $url_from . '/';
    $url_end = '.jpg';
    $url_list = array();
    for( $i = 1; $i <= $total; $i++ )
    {
        $url = $url_from . $i . $url_end;
        $url_list[] = $url;
    }

    return $url_list;
}

function save_image( $image_url )
{
    static $cnt = 0;

    $file_name = '' . $cnt . '.jpg';
    $content = file_get_contents($image_url);
    file_put_contents($file_name, $content);
    $cnt++;
}


?>