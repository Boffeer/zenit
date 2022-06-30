<?php get_header(); ?>

<?php echo zenit_breadcrumbs(); ?>

<section class="content-page dilers-page">
	<div class="container">
		<h1><?php the_title(); ?></h1>
		<div class="content-page__container">
			<div class="content-page__text">
				<?php the_content(); ?>
				<h3 class="form-page__title">
					Чтобы стать дилером, оставьте заявку
				</h3>
				<div class="form-page">
					<form action="/" class="form-page__forms">
						<input type="text" class="validation-input" data-placeholder="ФИО полностью *" placeholder="ФИО полностью *" />
						<input type="text" class="validation-input" data-placeholder="Номер телефона *" placeholder="Номер телефона *" />
						<input type="text" class="validation-input" data-placeholder="Email *" placeholder="Email *" />
						<input type="text" class="validation-input" data-placeholder="Город проживания *" placeholder="Город проживания *" />
						<textarea cols="30" rows="10" placeholder="Краткая информация о Вашей фирме"></textarea>
						<input type="submit" value="Оставить заявку" data-submit />
					</form>
				</div>

				<?php echo zenit_catalog_button(); ?>
			</div>
			<?php echo zenit_sidebar(); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
