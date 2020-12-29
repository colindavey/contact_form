<?php

function is_success($carry, $item) {
    return $carry && empty($item);
}

function get_check($var_name) {
    $bool = isset($_POST[$var_name]);
    return array($bool , $bool ? "checked" : "");
}

function html_escape(string &$unsafe_data): string
{
    return $unsafe_data = htmlspecialchars($unsafe_data, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8');
}

function trim_array($input)
{
    if (!is_array($input))
    {
        return trim($input);
    }
    return array_map('trim_array', $input);
}

function required_field_check(array $requiredFields, array $requestArray): array
{
    $error = array();
    foreach ($requiredFields as $field) {
        if (empty($requestArray[$field])) {
            $msg = ucwords(str_replace('_', ' ', $field));
            $error[$field] = $msg . ' required';
        }
    }
    return $error;
}

function required_field_init(array $requiredFields): array
{
    $error = array();
    foreach ($requiredFields as $field) {
        $error[$field] = '';
    }
    return $error;
}

function validate_white_list(array $whitelist)
{
    foreach ($_POST as $key => $val)
    {
        if (!in_array($key, $whitelist, true))
        {
            die('Hack-Attempt Detected. Please use only the fields in the form');
        }
    }
}