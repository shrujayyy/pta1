<?php
function pr($arr)
{
	echo '<pre>';
	print_r($arr);
}

function prx($arr)
{
	echo '<pre>';
	print_r($arr);
}

function get_safe_value_pta($conn, $str)
{
	if ($str != '') {
		$str = trim($str);
		return strip_tags(mysqli_real_escape_string($conn, $str));
	}
}

function get_safe_array_values_pta($conn, $array)
{
    $safe_array = array();

    foreach ($array as $key => $value) {
        if (!is_array($value) && $value !== '') {
            $safe_array[$key] = strip_tags(mysqli_real_escape_string($conn, trim($value)));
        }
    }

    return $safe_array;
}

?>