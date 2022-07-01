<?php get_header(); ?>

<?php echo zenit_breadcrumbs(); ?>

<section class="content-page">
	<div class="container catalog-page">
		<h1><?php echo get_queried_object()->label ?></h1>
		<button class="btn catalog-nav-btn">Открыть каталог</button>

		<div class="content-page__catalog">
			<div class="content-page__aside">
				<?php echo zenit_get_categories(); ?>
				<?php echo zenit_sidebar(array(
					'callback'
				)); ?>
			</div>

			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
				'page' => $paged,
				'paged' => $paged,
				// 'postsnumber' => 0,
				'post_type' => 'products',
				// 'posts_per_page' => 1,
			);
			$query = new WP_Query($args);
			?>

			<div class="content-page__wrapper">
				<div class="catalog-items">
					<?php if ($query->have_posts()) {
						/* Start the Loop */
						while ($query->have_posts()) {
							$query->the_post();

							get_template_part('template-parts/content', get_post_type());
						}
					} else {
						get_template_part('template-parts/content', 'none');
					} ?>
				</div>
			</div>
		</div>

		<?php
		$big = 999999999; // уникальное число
		?>
		<?php echo zenit_get_pagination(array(
			// 'base'    => user_trailingslashit(wp_normalize_path(get_permalink(get_the_id()) . '/%#%/')),
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total'   => $query->max_num_pages,
		));

		wp_reset_postdata();
		?>

	</div>
</section>

<?php get_footer(); ?>
