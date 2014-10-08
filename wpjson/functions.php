<?php
function escapeHtml($a){
	$output = str_replace(array("\r\n", "\r"), "\n", $a);
	$lines = explode("\n", $output);
	$new_lines = array();

	foreach ($lines as $i => $line) {
		if(!empty($line)) $new_lines[] = trim($line);
	}
	$b = implode($new_lines);
	$b = addslashes($b);
	return $b;
}
add_theme_support( 'post-thumbnails' ); 
add_filter( 'the_content', 'escapeHtml' );
add_filter( 'the_excerpt', 'escapeHtml' );
;
