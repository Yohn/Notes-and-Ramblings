<?php

$md = file_get_contents(__DIR__.'/md.md');
preg_match_all('/#### (.+?)\n/', $md, $out, PREG_PATTERN_ORDER);
foreach($out[1] as $line){
	$rm = str_replace('`', '', $line);
	// some files needed this one exploded
	$ex = explode('()', $rm);
	//$ex = explode(':', $rm);
	$link[] = '['.$ex[0].'](<#'.str_replace([':', ',', '.'], [' ', ' ', ''], $line).'>)';
}
echo count($link).' total found'.PHP_EOL.PHP_EOL;
$chunk = array_chunk($link, 3);
$tbl = '| some | thing | here |'.PHP_EOL.'| ----- | ----- | ----- |'.PHP_EOL;
foreach($chunk as $col){
	$tbl .= '| '.$col[0].' | '.$col[1].' | '.$col[2].' |'.PHP_EOL;
}
echo $tbl;
//implode("\n", $link);
//print_r($link);