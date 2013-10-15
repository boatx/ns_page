<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('simple_pag'))
{
    function simple_pag($page_num,$pages,$url)
    {
            $prev = $page_num + 1;
            $next = $page_num - 1;
            if ($next > 0)
            {
                echo "<a href=".site_url($url . $next).">Nowsze</a>";
            }
            if ($prev <= intval($pages))
            {
                echo "<a href=".site_url($url . $prev).">Starsze</a>";
            }

    }
}
