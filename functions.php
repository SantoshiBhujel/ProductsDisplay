<?php
function debug($variable)
{
    echo'<pre>';
    print_r($variable);
    echo'</pre>';
}
function dd($variable){//debug and die
    debug($variable);
    die();
}
