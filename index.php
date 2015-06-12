<?php
/**
 * MITstyle WordPress Theme
 * (C) 2015, Michael Ochmann
 * MIT license
 */
get_header();

echo "<main>";

if (have_posts()) {
	while (have_posts()) {
		the_post();
		$title 		= get_the_title();
		$date		= get_the_date();
		$permalink	= get_the_permalink();
		ob_start();
		the_content();
		$content = ob_get_clean();
		$post = new \mitstyle\Template("post-loop.php");
		$post->setValues(array(
			'title'		=> $title,
			'author'	=> get_the_author(),
			'content'	=> $content,
			'date'		=> $date,
			'permalink'	=> $permalink
		));
		$post->render();
	}
}

echo "</main>";

get_footer();