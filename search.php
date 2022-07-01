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
		<form class="search-page__form" data-search action="<?php echo home_url('/'); ?>" ?>
			<input class="search-page__form-input" type="text" placeholder="<?php echo get_search_query(); ?>" name="s" />
			<button class="search-page__form-btn btn" type="submit">
				Искать
			</button>
		</form>

		<?php
		// Убирает посты без рубрики
		foreach ($posts as $key => $post) {
			if (in_array(1, wp_get_post_categories($post->ID))) unset($posts[$key]);
		}
		?>

		<?php $search = new WP_Query("s=$s&showposts=-1"); ?>
		<?php if (have_posts()) : ?>
			<p class="search-page__text result">
				<?php printf(esc_html__('Результаты поиска: %s', 'zenit'), '<span>' . $search->post_count . '</span>'); ?>
			</p>
			<?php while (have_posts()) {
				the_post();
				if ($post->ID != NULL) {
					get_template_part('template-parts/content', 'search');
				}
			} ?>
		<?php else : ?>
			<?php get_template_part('template-parts/content', 'none'); ?>
		<?php endif; ?>
	</div>
	<?php echo zenit_get_pagination(); ?>
</section>

<?php
get_footer();
