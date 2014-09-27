<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('pagination_helper'))
{
    function pagination_helper($pagenum,$pagemax,$url,$num=3)
    {
        $n = 8;

        if ($pagenum >= 1 && $pagenum <= $pagemax)
        {
            if ($pagemax < $n)
            {
                for ($i=0;$i<$pagemax;$i++)
                {
                    echo "<a href=" . $url . $i . ">" . $i . "</a>";
                }
            }
            else
            {
                if ($pagenum == 1)
                {
                    for ($i=0;$i<=$n;$i++)
                    {
                        echo "<a href=" . $url . $i . ">" . $i . "</a>";
                    }
                    echo " ... ";
                    echo "<a href=" . $url . $i . ">" . $pagemax  . "</a>";

                }
                else if ($pagenum == $pagemax)
                {
                    echo "<a href=" . $url .  "1 >" . 1 . "</a>";
                    echo " ... ";
                    for ($i=0;$i<=$n;$i++)
                    {
                        echo "<a href=" . $url . $pagemax - $i . ">" . $pagemax - $i . "</a>";
                    }

                }
                else
                {
                    $x = $n/2;
                    echo "<a href=" . $url .  "1 >" . 1 . "</a>";
                    echo " ... ";
                    for ($i=$x;$i<=$x;$i++)
                    {
                        echo "<a href=" . $url . $pagenum - $i . ">" . $pagenum - $i . "</a>";

                    }
                    echo " ... ";
                    echo "<a href=" . $url . $pagemax . ">" . $pagemax  . "</a>" ;
                }
            }

        }

    }
}
