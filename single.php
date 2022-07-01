<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zenit
 */

get_header();
?>


<?php echo zenit_breadcrumbs(); ?>

<section class="detail-news-page">
	<div class="container">
		<h1><?php the_title(); ?></h1>
		<div class="detail-news-page__content">
			<img src="<?php echo esc_url((wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full')[0])) ?>" class="detail-news-page__content-picture" alt="" />
			<?php the_content(); ?>

			<div class="detail-news-page__slider">
				<div class="swiper">
					<div class="swiper-wrapper detail-news-page__wrapper">
						<?php $slider = carbon_get_post_meta(get_the_id(), 'news_slider') ?>
						<?php foreach ($slider as $slide) : ?>
							<a href="<?php echo esc_url((wp_get_attachment_image_src($slide, 'full')[0])) ?>" class="swiper-slide">
								<img src="<?php echo esc_url((wp_get_attachment_image_src($slide, 'full')[0])) ?>" alt="" />
							</a>
						<?php endforeach; ?>
					</div>
					<div class="detail-news-page__slider-flex">
						<div class="swiper__arrow-prev">
							<svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M11 21L1 11L11 1" stroke="#222222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</div>
						<div class="swiper__arrow-next">
							<svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 21L11 11L1 1" stroke="#222222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</div>
					</div>
				</div>
			</div>
			<div class="detail-news-page__footer fl-align">
				<a href="<?php echo get_post_type_archive_link(get_post_type()); ?>" class="btn">Вернуться к списку новостей</a>
				<?php echo zenit_share_buttons(get_the_id()); ?>
			</div>
		</div>
</section>


<?php
get_footer();
