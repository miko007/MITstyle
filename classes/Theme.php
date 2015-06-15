<?php

namespace mitstyle;

class Theme {
	private $ADMIN;

	public function __construct() {
		$this->ADMIN = new Admin();
		add_action('after_setup_theme',	array($this, 'generalSetup'));
		add_action('widgets_init', 		array($this, 'addWidgets'));
	}

	public function generalSetup() {
		add_theme_support('title-tag');
		add_theme_support('custom-background');
		add_theme_support('post-formats', array(
			'image',
			'quote',
			'status',
			'video',
			'aside'
		));
		register_nav_menu('top', 'Hauptmenü');
	}

	public function addWidgets() {
		register_sidebar(array(
			'name'          => 'After Posts',
			'id'            => 'after_posts',
			'before_widget' => "<section class='primary-sidebar-widget'><section class='widget-container'>",
			'after_widget'  => '</section></section>',
			'class'			=> 'MITwidgets',
			'before_title'  => '<h3 class="widgetTitle">',
			'after_title'   => '</h3>'
		));
	}

	public static function getColorSchemes() {
		return json_decode(file_get_contents(MITSTYLE_PATH."/json/colorSchemes.json"));
	}

	public static function getColorScheme() {
		//$schemeActive 	= get_option("MITcolorScheme");
		$schemes 		= json_decode(file_get_contents(MITSTYLE_PATH."/json/colorSchemes.json"));
		//return $schemes->$schemeActive;
		return $schemes->default;
	}

	public static function getSocial() {
		return json_decode(base64_decode(get_option("MITsocial")));
	}

	public static function getSocialArray() {
		$out = array();
		foreach (Theme::getSocial() as $social) {
			$out[$social->name] = $social->link;
		}
		return $out;
	}

	public static function getLogo() {
		$logo = get_option("MITlogo");
		return $logo == "" ? "" : "<img src='$logo' alt='".get_bloginfo("title")."'>";
	}
}
