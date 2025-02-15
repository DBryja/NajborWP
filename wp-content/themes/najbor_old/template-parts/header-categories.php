<?php
$lang = get_site_language();
$home = get_home_url();
$categories = get_katprace_categories_with_translations();
$all_label = ml_menuItems()["wszystkie"];
$current_slug = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); // Get current page slug
?>
<div class="categories-list hideOnScroll">
	<?php foreach($categories as $cat){
		$name = $cat["name_" . $lang];
		$slug = $cat["slug"];
		// Skip the current category
		if($slug === $current_slug) continue;
		?>
		<h4>
			<a href="<?php echo $home.'/prace/'.$slug ?>">
				<?php echo $name?>
			</a>
		</h4>
	<?php }
	if(!is_page("prace")): ?>
		<h4><a href='<?php echo $home."/prace" ?>'><?php echo $all_label[$lang]?></a></h4>
	<?php endif; ?>
</div>