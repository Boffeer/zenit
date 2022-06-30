<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package zenit
 */

get_header();
?>

<?php echo zenit_breadcrumbs(); ?>

<section class="search-page">
	<div class="container">
		<h1>Поиск</h1>
		<form class="search-page__form">
			<input class="search-page__form-input" type="text" placeholder="Фаршемешалка" />
			<button class="search-page__form-btn btn" type="button">
				Искать
			</button>
		</form>

		<?php if (have_posts()) :
		?>
			<p class="search-page__text result">
				<?php printf(esc_html__('Результаты поиска: %s', 'zenit'), '<span>' . count($posts) . '</span>'); ?>
			</p>
			<?php while (have_posts()) {
				the_post();
				get_template_part('template-parts/content', 'search');
			} ?>
		<?php else : ?>
			<?php get_template_part('template-parts/content', 'none'); ?>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
