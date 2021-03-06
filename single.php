<?php
/**
 * MITstyle
 *
 * Template for a single post
 */
get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		$title 			= get_the_title();
		$date			= get_the_date();
		$permalink		= get_the_permalink();
		$getCategories 	= get_the_category();
		$categories		= "";
		$i	= 1;
		foreach ($getCategories as $category) {
			$separator = $i < count($getCategories) - 1 ? ", " : " und ";
			$separator = $i == count($getCategories) ? "" : $separator;
			$categories .= sprintf("<a href='".get_category_link($category->term_id)."'>%s</a>", $category->name).$separator;
			$i++;
		}
		ob_start();
		the_content();
		$content = ob_get_clean();
		ob_start();
		comment_form();
		$commentForm = ob_get_clean();
		$comments = wp_list_comments(array(
			'echo' 			=> false,
			'avatar_size'	=> '80'
		), get_comments(array(
			'post_id'	=> $post->ID
		)));
		$postC	= new \mitstyle\Post($post, $content);
		$customContent = get_post_format($post->ID) ? $postC->render(false) : $content;
		$post = new \mitstyle\Template("post-single.php");
		if ($categories != "") {
			$catOutput = new \mitstyle\Template("post-sub-categories.php");
			$catOutput->setValues(array(
				'cat'	=> $categories
			));
			$categories = $catOutput->render(false);
		}
		else
			$categories = "";
		$post->setValues(array(
			'title'			=> $title,
			'content'		=> $customContent,
			'date'			=> $date,
			'permalink'		=> $permalink,
			'categories'	=> $categories,
			'authorName'	=> get_the_author_meta('display_name'),
			'homepage'		=> get_the_author_meta('user_url'),
			'bio'			=> get_the_author_meta('description'),
			'url'			=> get_author_posts_url(get_the_author_meta('ID')),
			'avatar'		=> get_avatar_url(get_the_author_meta('ID')),
			'commentForm'	=> $commentForm,
			'comments'		=> $comments
		));
		$post->render();
	}
}

get_footer();