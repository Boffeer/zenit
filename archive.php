<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zenit
 */

get_header();
?>

<main>
	<div class="container">
		<div class="breadcrumbs">
			<ul class="breadcrumbs-list">
				<li class="breadcrumbs-list__element">
					<a href="">Главная</a>
				</li>
				<li class="breadcrumbs-list__element">Новости</li>
			</ul>
		</div>
	</div>
</main>

<section class="news-page">
	<div class="container">
		<h1><?php echo get_queried_object()->label ?></h1>
		<div class="news-page__box">
			<div class="section_news__container">
				<?php if (have_posts()) : ?>
				<?php
					/* Start the Loop */
					while (have_posts()) :
						the_post();

						/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
						get_template_part('template-parts/content', get_post_type());

					endwhile;

					the_posts_navigation();

				else :

					get_template_part('template-parts/content', 'none');

				endif; ?>
			</div>
		</div>
		<div class="pagination fl-align">
			<button class="pagination-prev">
				<svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M11 21L1 11L11 1" stroke="#222222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</button>
			<ul class="pagination__list fl-align">
				<li class="pagination__list-element _active">1</li>
				<li class="pagination__list-element">2</li>
				<li class="pagination__list-element">3</li>
				<li class="pagination__list-element">...</li>
				<li class="pagination__list-element">10</li>
			</ul>
			<button class="pagination-next">
				<svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 21L11 11L1 1" stroke="#222222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</button>
		</div>
	</div>
</section>

<?php
// get_sidebar();
get_footer();
