<?php get_header(); ?>
<?php echo zenit_breadcrumbs(); ?>
<section class="certificates-page">
	<div class="container">
		<h1 class="certificates-page__main-title"><?php echo get_queried_object()->label ?></h1>
		<div class="certificates-page__list">

			<?php if (have_posts()) : ?>
				<?php
				/* Start the Loop */
				while (have_posts()) :
					the_post();

					$photo = carbon_get_post_meta($post->ID, 'photo');
				?>
					<div class="certificates-page__item">
						<a class="spotlight" href="<?php echo $photo; ?>">
							<img class="certificates-page__img" src="<?php echo $photo; ?>" alt="<?php the_title(); ?>" />
						</a>
						<div class="certificates-page__content">
							<p class="certificates-page__title"><?php the_title(); ?></p>
							<?php $desc = boffeer_explode_tinymc(carbon_get_post_meta($post->ID, 'cert_desc')); ?>
							<?php if (!empty($desc)) : ?>
								<?php foreach ($desc as $row) : ?>
									<p class="certificates-page__text">
										<?php echo $row; ?>
									</p>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>

			<?php
				endwhile;

			else :

				get_template_part('template-parts/content', 'none');

			endif; ?>
		</div>

		<?php echo zenit_get_pagination(); ?>
		<?php echo zenit_catalog_button(array(
			'classlist' => 'certificates-page__btn',
		)); ?>
	</div>
</section>
<?php get_footer(); ?>
