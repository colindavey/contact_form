<?php

function dd($data)
{
    dump($data);
    die;
}
function dump(...$data)
{
    var_dump(...$data);
}