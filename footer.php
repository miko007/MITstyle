<?php
	wp_footer();
?>
<footer>
	Copyright &copy; 2015, <a href="<?php echo get_bloginfo('url') ?>"><?php echo get_bloginfo('name') ?></a>
</footer>
<nav class="socialIcons">
	<ul>
<?php
$socials = \mitstyle\Theme::getSocial();
foreach ($socials as $social) {
	echo "\t\t<li><a href='$social->link' class='fa $social->fontawesome'></a></li>\n";
}
?>
	</ul>
</nav>
</body>
</html>