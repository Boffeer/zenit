<?php get_header(); ?>

<?php echo zenit_breadcrumbs(); ?>

<section class="vakansion-page">
	<div class="container">
		<h1><?php echo get_queried_object()->label ?></h1>
		<p class="vakansion-page__text">
			Наша компания стремительно развивается, и в связи с этим, нам для
			достижения поставленных целей нужны ценные сотрудники, которые
			помогу выполнить все поставленные задачи. Если Вас интересует
			интересная работа, оставляйте заявку, и наш менеджер свяжется с Вами
			для назначения встречи и собеседования
		</p>
		<div class="vakansion-page__container">
			<?php
			//$jobs = carbon_get_post_meta('jobs')
			?>
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
		<div class="form-page" id="jobs-form">
			<h2 class="form-page__title">Отклик на вакансию</h2>
			<form action="/" class="form-page__forms">
				<input type="text" class="validation-input" data-placeholder="ФИО полностью *" placeholder="ФИО полностью *" />
				<input type="tel" class="validation-input" data-placeholder="Номер телефона *" data-mask="+7 (___) ___-__-__" placeholder="Номер телефона *" />
				<input type="text" class="validation-input" data-placeholder="Email *" placeholder="Email *" />
				<input type="text" class="validation-input" data-placeholder="Город проживания *" placeholder="Город проживания *" />
				<textarea cols="30" rows="10" placeholder="Краткая информация о Вашей фирме"></textarea>
				<input type="submit" value="Оставить заявку" data-submit />
			</form>
		</div>
	</div>
</section>

<?php get_footer(); ?>
