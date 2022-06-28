<?php

add_shortcode('trending', 'the_trending_items');

/**
 * @type - if packs or pack, render packs. If not provided - render icons
 */
function the_trending_items($attr, $content)
{
	$trending = array();
	if (is_array($attr)) {
		if ($attr['type'] === 'packs' || $attr['type'] === 'pack') {
			$trending['type'] = 'packs';
			$trending['title'] = 'Trending icon packs';
			$trending['button'] = 'All packs';
			$trending['carbon'] = 'trending_packs';
		}
	}
	if (empty($trending)) {
		$trending['type'] = 'icon';
		$trending['title'] = 'Trending icons';
		$trending['button'] = 'All icons';
		$trending['carbon'] = 'trending_icons';
	}
	ob_start(); ?>
	<section class="recommend-list">
		<div class="recommend-list__wrap wrap">
			<div class="recommend-list__header flex flex_justify">
				<div class="recommend-list__cell recommend-list__cell_title">
					<h2 class="recommend-list__title h3"><?php echo $trending['title']; ?></h2>
				</div>
				<div class="recommend-list__cell recommend-list__cell_nav">
					<a class="recommend-list__link arrow-link" href="<?php echo esc_url(get_post_type_archive_link($trending['type'])) ?>"><span class="arrow-link__text"> <?php echo $trending['button']; ?></span><span class="arrow-link__icon"><svg class="icon icon-arrowRight" viewBox="0 0 24 24">
								<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/app/icons/sprite.svg#arrowRight"></use>
							</svg></span></a>
				</div>
			</div>
			<div class="recommend-list__list flex">
				<?php
				$trending_cards = carbon_get_theme_option($trending['carbon']);
				i3d_the_crb_posts($trending_cards);
				?>
			</div>
		</div>
	</section>
<?php
	return ob_get_clean();
}

add_shortcode('br', 'i3d_insert_br');
function i3d_insert_br($attr, $content)
{
	return "\n";
}

add_shortcode('bullet', 'i3d_insert_bullet');
function i3d_insert_bullet($attr, $content)
{
	ob_start();
?>
	<?php
	if (isset($attr['color'])) :
		if ($attr['color'] == 'green') : ?>
			<div class="card__item-icon card__item-icon_green">
				<svg class="icon icon-check" viewBox="0 0 16 16">
					<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/app/icons/sprite.svg#check"></use>
				</svg>
			</div>
		<?php elseif ($attr['color'] == 'red') : ?>
			<div class="card__item-icon card__item-icon_red">
				<svg class="icon icon-attention" viewBox="0 0 16 16">
					<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/app/icons/sprite.svg#attention"></use>
				</svg>
			</div>
		<?php endif; ?>
	<?php else :  ?>
		<div class="card__item-icon card__item-icon_blue">
			<svg class="icon icon-check" viewBox="0 0 16 16">
				<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/app/icons/sprite.svg#check"></use>
			</svg>
		</div>
	<?php endif; ?>
	<span class="card__item-text"> <?php /* Opening tag to bullet content */ ?>

	<?php return ob_get_clean();
}
