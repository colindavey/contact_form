<?php

function is_success($carry, $item) {
    return $carry && empty($item["warning"]);
}

function get_check($var_name) {
    $bool = isset($_POST[$var_name]);
    return array($bool , $bool ? "checked" : "");
}

function html_escape(string &$unsafe_data): string
{
    return $unsafe_data = htmlspecialchars($unsafe_data, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8');
}
