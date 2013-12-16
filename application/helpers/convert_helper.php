<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('EntitiesToList'))
{
   	function EntitiesToList($arr) {
   		
		if ( is_array($arr) ) {
			$nArr = array();
			
			for($i = 0; $i < count($arr); $i++) {			
				$nArr[$i] = $arr[$i]->ToArray();
			}
			
			return $nArr;
		} elseif(is_object($arr)) {
			$arr = $arr->ToArray();
		}
		return $arr;
	}
}