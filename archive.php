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

<section class="<?php echo get_queried_object()->name . '-page'; ?>">
	<div class="container">
		<h1><?php echo get_queried_object()->label
				?></h1>
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

				else :

					get_template_part('template-parts/content', 'none');

				endif; ?>
			</div>
		</div>
		<?php if (zenit_get_pagination()) : ?>
			<div class="pagination fl-align">
				<?php echo zenit_get_pagination();  ?>
			</div>
		<?php endif; ?>
		<?php if (get_queried_object()->name != 'news') {
			echo zenit_catalog_button();
		} ?>
	</div>
</section>

<?php
// get_sidebar();
get_footer();
