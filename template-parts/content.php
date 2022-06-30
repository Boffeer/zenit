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
<?php elseif ($post->post_type == 'jobs') : ?>

	<?php $location	= carbon_get_post_meta(get_the_id(), 'location'); ?>

	<div class="vakansion-page_accordion">
		<div class="vakansion-page_accordion__header fl-align">
			<p class="vakansion-page_accordion__header-city">
				<?php echo $location; ?>
			</p>
			<p class="vakansion-page_accordion__header-job">
				<?php the_title(); ?>
			</p>
			<button class="vakansion-page_accordion__header-btn fl-align">
				Подробнее
				<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 11L6 6L1 1" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</button>
		</div>
		<div class="vakansion-page_accordion__body">
			<div class="vakansion-page_accordion__body-line fl-align">
				<p class="vakansion-page_accordion__body-line-city">
					<?php echo $location; ?>
				</p>
				<p class="vakansion-page_accordion__body-line-job">
					<?php the_title(); ?>
				</p>
			</div>
			<div class="vakansion-page_accordion__body-box">
				<?php $desc = carbon_get_post_meta(get_the_id(), 'desc'); ?>

				<?php foreach ($desc as $box) : ?>
					<p class="vakansion-page_accordion__body-box-title">
						<?php echo $box['title'] ?>
					</p>
					<ul class="vakansion-page_accordion__body-box-list">
						<?php $bullets = boffeer_explode_textarea($box['desc']); ?>
						<?php foreach ($bullets as $bullet) : ?>
							<li><?php echo $bullet; ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endforeach; ?>
			</div>

			<a href="#jobs-form" class="btn vakansion-click" data-job="<?php the_title(); ?>">
				Откликнуться на вакансию
			</a>
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
