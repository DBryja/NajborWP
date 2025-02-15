<?php
$lang = get_site_language();
$categories = get_katprace_categories_with_translations();
$all_label = ml_menuItems()["wszystkie"];
$home_url = get_home_url_with_prefix($lang);

// Pobranie aktualnej kategorii (jeśli jesteśmy na stronie kategorii)
$current_category = get_queried_object();
$current_slug = $current_category ? $current_category->slug : null;

// Sprawdzenie, czy jesteśmy na STRONIE GŁÓWNEJ /prace/, ale NIE na podstronie kategorii
$is_main_prace_page = is_post_type_archive('prace') || (is_page('prace') && !$current_category);
?>
<div class="categories-list hideOnScroll">
	<?php foreach($categories as $cat){
		$name = $cat["name_" . $lang];
		$slug = $cat["slug"];
		// Skip the current category
		if($slug === $current_slug) continue;
		?>
		<h4>
			<a href="<?php echo $home_url.'/prace/'.$slug ?>">
				<?php echo $name?>
			</a>
		</h4>
	<?php }
	// Ukrywamy "Wszystkie" TYLKO na głównej stronie /prace/
	if(!$is_main_prace_page): ?>
		<h4><a href='<?php echo $home_url."/prace" ?>'><?php echo $all_label[$lang]?></a></h4>
	<?php endif; ?>
</div>
