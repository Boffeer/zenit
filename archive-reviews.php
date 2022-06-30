<?php get_header(); ?>

<?php echo zenit_breadcrumbs(); ?>

<section class="reviews-page">
	<div class="container">
		<h1><?php echo get_queried_object()->label ?></h1>
		<ul class="reviews-page__list">
			<?php if (have_posts()) : ?>
				<?php
				/* Start the Loop */
				while (have_posts()) :
					the_post();
				?>
					<li>
						<h4 class="reviews-page__title"><?php echo $post->post_title; ?></h4>
						<p class="reviews-page__info">
							<?php echo carbon_get_post_meta($post->ID, 'subtitle'); ?>
						</p>
						<p class="reviews-page__text">
							<?php echo nl2br(carbon_get_post_meta($post->ID, 'review')); ?>
						</p>
					</li>
			<?php
				endwhile;

			else :

				get_template_part('template-parts/content', 'none');

			endif; ?>
		</ul>

		<?php echo zenit_get_pagination();  ?>
		<button class="reviews-page__btn btn" data-modal-open="otzyv">Оставить отзыв</button>
	</div>
</section>

<?php get_footer(); ?>
