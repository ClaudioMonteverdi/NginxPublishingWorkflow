<?php
function clean_date($date){
	return date("D, M d Y", strtotime($date));
}
function clean_time($date){
	return date("g:i a", strtotime($date));
}

function clean_datetime($date, $sep = ' at ')
{
	return clean_date($date) . $sep . clean_time($date);
}
