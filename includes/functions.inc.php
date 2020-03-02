<?php
function safeInt($int){
	return filter_var($int, FILTER_VALIDATE_INT);
}
function safeString($str){
	return filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
}
function safeFloat($float){
	return filter_var($float, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
}
?>