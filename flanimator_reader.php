<?php
/*
Plugin Name: Flanimator Reader
Plugin URI: http://www.online-solution.biz/
Description: German Post Reader - Flanimator
Version: 0.1
Author: Andreas Rabuser
Author URI: http://de.online-solution.biz/
Min WP Version: 1.5
Max WP Version: 2.8
*/
add_filter('the_content','flanimator_reader_content');
function flanimator_reader_content($content)
{
	$flanimator='
	<div id="div4flanimator" style="border:0;padding:0;display:block;height:40px;width:250px;overflow:hidden;">
	<form id="form4flanimator" onsubmit="form2iframe4flanimator();" target="iframe4flanimator" action="http://flanimator.looky-look.net/reader/" method="post">
		<input type="hidden" value="'.clean4flanimator($content).'" name="s" />
		<input type="hidden" name="l" value="de" />
		<input style="margin:0;padding:0;border:0;width:200px;height:35px;background:url(http://flanimator.looky-look.net/reader/btn.png)" type="submit" value="&nbsp;" id="flanimator-play" />
	</form>
	<iframe name="iframe4flanimator" id="iframe4flanimator" scrolling="no" frameborder="0" width="1" height="1"></iframe>
	</div>
	<script><!--
		function form2iframe4flanimator()
		{
			document.getElementById(\'form4flanimator\').style.display=\'none\';
			document.getElementById(\'form4flanimator\').style.visibility=\'hidden\';
			document.getElementById(\'iframe4flanimator\').width=\'250\';
			document.getElementById(\'iframe4flanimator\').height=\'40\';
		}
	--></script>';
	return $flanimator.$content;
}
function strip_tags_incl_script($text,$allow)
{
	$text = preg_replace("/(\<script)(.*?)(script>)/si", "dada", "$text");
	$text = strip_tags($text,$allow);
	$text = str_replace("<!--", "&lt;!--", $text);
	$text = preg_replace("/(\<)(.*?)(--\>)/mi", "".nl2br("\\2")."", $text);
	return $text;
}
function clean4flanimator($html)
{
	$html=strip_tags_incl_script($html,'');
	$html=str_replace('\'',' ',$html);
	$html=str_replace('"',' ',$html);
	$html=str_replace('<',' ',$html);
	$html=str_replace('>',' ',$html);
	return $html;
}
?>