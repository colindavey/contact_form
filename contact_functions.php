<?php

function is_success($carry, $item) {
    return $carry && empty($item);
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

function validate_white_list(array $whitelist, array $request_array)
{
    foreach ($request_array as $key => $val)
    {
        if (!in_array($key, $whitelist, true))
        {
            // die('Hack-Attempt Detected. Please use only the fields in the form.');
            // die('Hack-Attempt Detected.');
            hack_attempt("fields");
        }
    }
}
function validate_token($session, $post, $expired_page) {
    if ($session['token']!=$post['token']) {
        // hack_attempt("token");
        redirect($expired_page);
    } else if (time() >= $session['token-expire']) {
        redirect($expired_page);
    }
}

function redirect($location) {
    header("location: ".$location);
}

function hack_attempt($text) {
    die('Hack-Attempt Detected. '.$text);
}