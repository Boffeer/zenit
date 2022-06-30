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

			<div class="content-page__wrapper">
				<div class="catalog-items">
					<?php if (have_posts()) {
						/* Start the Loop */
						while (have_posts()) {
							the_post();

							get_template_part('template-parts/content', get_post_type());
						}
					} else {
						get_template_part('template-parts/content', 'none');
					} ?>
				</div>
			</div>
		</div>

		<?php echo zenit_get_pagination();  ?>

	</div>
</section>

<?php get_footer(); ?>
