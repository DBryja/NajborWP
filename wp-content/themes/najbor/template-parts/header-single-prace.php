<?php
$lang = get_site_language();

$term_name = '';
$term_slug = '';
$ID = get_the_ID();
$queried_object = get_queried_object();
$terms = get_the_terms( get_the_ID(), 'katprace' );
$working_object = $queried_object;
if ( $terms && !is_wp_error( $terms ) ) {
	$working_object = $terms[0];
}
$term_id = $working_object->term_id;
$term_name = $working_object->name;
$term_slug = $working_object->slug;
if ($lang != "pl"){
	$term_name = get_field($lang, 'katprace_' . $term_id);
}
?>

<a href="<?php echo get_term_link($term_slug, 'katprace'); ?>" class="hideOnScroll">
	<?php echo $term_name?>
</a>