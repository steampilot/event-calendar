<?php

/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2014 <odan>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * HTML Encoding: Write html encoded string
 *
 * @param string $str string to encode
 */
function wh($str) {
	echo h($str);
}

/**
 * json encoder
 * @param type $array
 * @param int $options
 * @return string
 */
function encode_json($array, $options = 0) {
	$str = json_encode(encode_utf8($array), $options);
	return $str;
}

/**
 * json decoder
 * @param string $strJson
 * @return array
 */
function decode_json($strJson) {
	$arr = json_decode($strJson, true);
	return $arr;
}

/**
 * Encodes an ISO-8859-1 string or array to UTF-8
 * @param mixed $str string or array
 * @return mixed string or array
 */
function encode_utf8($str) {
	if ($str === null || $str === '') {
		return $str;
	}

	if (is_array($str)) {
		foreach ($str as $strKey => $mixVal) {
			$str[$strKey] = encode_utf8($mixVal);
		}
		return $str;
	} else {
		if (!mb_check_encoding($str, 'UTF-8')) {
			return mb_convert_encoding($str, 'UTF-8');
		} else {
			return $str;
		}
	}
}

/**
 * Returns the current date and time in IS0-8601 format
 * Format: Y-m-d H:i:s
 *
 * @return string
 */
function now() {
	return date('Y-m-d H:i:s');
}

/**
 * Converts any date/time format (default is d.m.Y)
 *
 * @param string $str_time
 * @param string $str_format
 * @param mixed $mix_default
 * @return string or $mix_default
 *
 * <code>
 * echo format_time('2011-03-28 15:14:30') -> '28.03.1982'
 * echo format_time('2011-03-28 15:10:5', 'd.m.Y H:i:s') -> '28.03.1982 15:10:05'
 * echo format_time('2011-3-22 23:01:45', 'H:i:s') -> '23:01:45'
 * echo format_time('2014-14-31', 'H:i:s', 'not valid') -> 'valid'
 * </code>
 */
function format_time($str_time, $str_format = 'd.m.Y', $mix_default = '') {
	if (empty($str_time) || $str_time === '0000-00-00 00:00:00' || $str_time === '0000-00-00') {
		return $mix_default;
	}
	$num_time = strtotime($str_time);
	if ($num_time === false) {
		return $mix_default;
	}
	$str_return = date($str_format, $num_time);
	return $str_return;
}

function alert($strMsg, $strType = 'alert-success', $boolClose = true) {
	$strClass = trim(implode(' ', array('alert', $strType, $boolClose ? 'alert-dismissable' : '')));
	$strReturn = sprintf('<div class="%s">', $strClass);
	if ($boolClose) {
		$strReturn .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
	}
	$strReturn .= h($strMsg);
	$strReturn .= '</div>';
	return $strReturn;
}

/**
 * Interpolates context values into the message placeholders.
 *
 * @param string $message
 * @param array $context
 * @return string
 */
function interpolate($message, array $context = array()) {
	// build a replacement array with braces around the context keys
	$replace = array();
	foreach ($context as $key => $val) {
		$replace['{' . $key . '}'] = $val;
	}
	// interpolate replacement values into the message and return
	return strtr($message, $replace);
}

/**
 * Returns true if the variable is blank.
 * When you need to accept these as valid, non-empty values:
 *
 * - 0 (0 as an integer)
 * - 0.0 (0 as a float)
 * - "0" (0 as a string)
 *
 * @param mix $mixValue
 * @return boolean
 */
function blank($mixValue) {
	return empty($mixValue) && !is_numeric($mixValue);
}
