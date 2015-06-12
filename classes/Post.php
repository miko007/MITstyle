<?php

namespace mitstyle;

class Post {
	private $post;
	private $ID;
	private $title;
	private $autor;
	private $date;
	private $content;
	private $commentCount;
	private $permalink;
	private $format;
	private $template;
	private $skeleton;
	private $templateValues;

	public function __construct($post, $content) {
		$this->post 	= $post;
		$this->content	= $content;
		$this->ID		= $post->ID;
		$this->format	= get_post_format($this->ID);
		$this->extract();
	}

	public function render($display = true) {
		switch ($this->format) {
			case "quote":
				$this->template = "post-quote.php";
				$this->templateValues = array(
					'title'		=> $this->title,
					'author'	=> $this->autor,
					'content'	=> $this->content,
					'date'		=> $this->date,
					'permalink'	=> $this->permalink,
					'authorURL'	=> get_author_posts_url($this->post->post_author)
				);
				break;
			case "image":
				$this->template = "post-image.php";
				$attachments = get_attached_media('image', $this->ID);
				preg_match("/<img .*?(?=src)src=\"([^\"]+)\"/si", $this->content, $media);
				$media = empty($media) ? array("url", strip_tags($this->content)) : $media;
				$image = !empty($attachments) ? wp_get_attachment_image_src($attachments[0]->ID) : $media[1];
				$this->templateValues = array(
					'title'		=> $this->title,
					'author'	=> $this->autor,
					'content'	=> $this->content,
					'date'		=> $this->date,
					'permalink'	=> $this->permalink,
					'authorURL'	=> get_author_posts_url($this->post->post_author),
					'image'		=> $image
				);
				break;
			default:
				$this->template ="post-loop.php";
				$this->templateValues = array(
					'title'		=> $this->title,
					'author'	=> $this->autor,
					'content'	=> $this->content,
					'date'		=> $this->date,
					'permalink'	=> $this->permalink
				);
				break;
		}
		$this->skeleton = new Template($this->template);
		$this->skeleton->setValues($this->templateValues);
		if ($display)
			$this->skeleton->render();
		else
			return $this->skeleton->render(false);
	}

	private function extract() {
		$this->title		= get_the_title($this->ID);
		$this->commentCount	= get_comment_count($this->ID);
		$this->autor		= get_the_author_meta('display_name', $this->post->post_author);
		$this->date			= get_the_date("", $this->ID);
		$this->permalink	= get_the_permalink($this->ID);
	}
} 