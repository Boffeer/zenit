<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zenit
 */

?>

<?php if ($post->post_type == 'partners') : ?>
	<div class="partners-page__element">
		<div class="partners-page__element-picture">
			<img src="<?php echo esc_url((wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0])) ?>" alt="<?php the_title(); ?>" />
		</div>

		<div class="partners-page__element-text">
			<h2 class="partners-page__element-header">
				<?php the_title(); ?>
			</h2>
			<p class="partners-page__element-info">
				Оборудование для нарезки продукта на ломтики и порции, кубики
				и полоски, слайсеров.
			</p>
		</div>
	</div>
<?php else : ?>
	<div id="post-<?php the_ID(); ?>" class="section_news__element">
		<img class="section_news__element-picture" src="<?php echo esc_url((wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0])) ?>" alt="<?php echo $post->post_title; ?>" />
		<div class="section_news__element-box">
			<h3 class="section_news__element-header">
				<?php echo $post->post_title; ?>
			</h3>
			<a class="section_news__element-link" href="<?php echo esc_url(the_permalink()); ?>">Подробнее</a>
		</div>
	</div>
<?php endif; ?>
