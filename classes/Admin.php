<?php

namespace mitstyle;

class Admin {
	private $tabs;

	public function __construct() {
		add_action('admin_menu',			array($this, 'addPages'));
		add_action('admin_enqueue_scripts',	array($this, 'addStyles'));
		$this->tabs = array(
			'start' 	=> 'General Settings',
			'social'	=> 'Social Icons',
			'footer'	=> 'Footer'
		);
	}

	public function addPages() {
		add_theme_page('MITstyle Options', 'Theme Options', 'manage_options', 'theme-options', array($this, 'drawOptionsPage'));
	}

	public function addStyles() {
		wp_enqueue_media();
		wp_register_style('MITadmin', get_template_directory_uri().'/css/admin.css', false, '0.0.1' );
		wp_register_style('toggles', get_template_directory_uri().'/css/toggles.css', false, '0.0.1' );
		wp_register_script('MITstyle', get_template_directory_uri().'/javascript/MITstyle.js', false, '0.0.1');
		wp_enqueue_style('toggles');
		wp_enqueue_script('MITstyle');
		wp_enqueue_style('MITadmin');
	}

	public function drawOptionsPage() {
		$tab 		= isset($_GET["tab"]) ? $_GET["tab"] : "start";
		$tabContent	= array_key_exists($tab, $this->tabs) ?
			$this->{"tab".ucfirst($tab)}() :
			"The requested page doesn't exist.";
		$template = new Template("admin-options.php");
		$template->setValues(array(
			'tabs'			=> $this->adminTabs($tab),
			'tabContent'	=> $tabContent
		));
		$template->render();
	}

	public function adminTabs($current = 'start') {
		$output = "";
		$output .= "<h2 class='nav-tab-wrapper' style='margin-bottom: 20px;'>";
		foreach($this->tabs as $tab => $name){
			$class = ($tab == $current) ? ' nav-tab-active' : '';
			$output .= "<a class='nav-tab$class' href='?page=theme-options&tab=$tab'>$name</a>";

		}
		$output .= '</h2>';

		return $output;
	}

	private function process($which) {
		switch ($which) {
			case "social":
				$socials = json_decode(file_get_contents(MITSTYLE_PATH."/json/socialIcons.json"));
				$MITsocial = array();
				foreach ($socials as $social) {
					if ($_POST["MIT".$social->name] == "")
						continue;
					$object = new \stdClass();
					$object->name			= $social->name;
					$object->fontawesome	= $social->fontawesome;
					$object->link 			= $_POST["MIT".$social->name];
					array_push($MITsocial, $object);
				}
				$MITrssdisplay = isset($_POST["MITrss"]) && $_POST["MITrss"] == 1 ? true : false;
				update_option("MITrss", $MITrssdisplay);
				update_option("MITsocial", base64_encode(json_encode($MITsocial)));
				break;
			default:
				return;
		}
	}

	private function tabStart() {
		$template = new Template("admin-general.php");
		return $template->render(false);
	}

	private function tabSocial() {
		if (isset($_POST["MITprocess"]))
			$this->process($_POST["MITprocess"]);
		$socials 	= json_decode(file_get_contents(MITSTYLE_PATH."/json/socialIcons.json"));

		$socialRows	= "";
		$socialLinks = Theme::getSocialArray();
		foreach ($socials as $social) {
			$template = new Template("admin-social-row.php");
			$template->setValues(array(
				'name'			=> $social->name,
				'displayName'	=> $social->displayName,
				'value'			=> $socialLinks[$social->name]
			));
			$socialRows .= $template->render(false);
		}
		$rssDisplay = get_option("MITrss") ? "checked" : "";
		$template = new Template("admin-social.php");
		$template->setValues(array(
			'socialRows'	=> $socialRows,
			'rssChecked'	=> $rssDisplay
		));
		return $template->render(false);
	}
} 