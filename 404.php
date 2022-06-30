<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package zenit
 */

get_header();
?>

<?php echo zenit_breadcrumbs(); ?>

<section class="not-found-page">
	<div class="container">
		<h1>
			<span>Ошибка 404</span>
			<span>Страница не найдена</span>
		</h1>
		<a href="<?php home_url('/'); ?>" class="not-found-page__btn btn">Вернуться на главную</a>
	</div>
</section>

<?php
get_footer();
