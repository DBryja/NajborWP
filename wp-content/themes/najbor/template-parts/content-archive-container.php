<?php
$lang = get_site_language();
$for_sale = ml_for_sale();
?>

<div class="container">
	<?php if ( have_posts() ) : ?>
		<div class="prace-archive">
			<?php while ( have_posts() ) : the_post();
				$ID = get_the_ID();
				$image = get_field("Obraz", $ID);
				$forSaleAttrib=get_forSale_attrib($ID, $for_sale[$lang]);
				?>
				<div class="prace-archive__row">
                    <span class="prace-archive__anchor" id="post-<?php the_ID(); ?>">&nbsp;</span>
					<article class="prace-archive__item" data-shape="<?php echo get_image_shape($image["width"], $image["height"]); ?>">
						<a href="<?php the_permalink();?>" <?php echo $forSaleAttrib?>>
							<picture>
								<source srcset="<?php echo $image["url"]?>.webp" type="image/webp">
								<source srcset="<?php echo $image["url"]?>">
								<img src="<?php echo $image["url"]?>" loading="lazy" alt="<?php echo $image["alt"]?>">
							</picture>
						</a>
					</article>
				</div>
			<?php endwhile; ?>
		</div>

	<?php else : ?>
		<p><?php esc_html_e( 'Nie znaleziono żadnych prac.', 'twoj-motyw' ); ?></p>
	<?php endif; ?>


    <div class="navigation">
		<?php if(function_exists('pagenavi')) { pagenavi(); } ?>
    </div>
</div>
