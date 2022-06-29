<?php get_header(); ?>

<?php
$page_id = get_the_id();
$contacts = zenit_get_contacts();
?>

<main>
	<div class="container">
		<div class="breadcrumbs">
			<ul class="breadcrumbs-list">
				<li class="breadcrumbs-list__element">
					<a href="">Главная</a>
				</li>
				<li class="breadcrumbs-list__element">О компании</li>
			</ul>
		</div>
	</div>
</main>

<section class="content-page">
	<div class="container">
		<h1><?php the_title(); ?></h1>
		<div class="content-page__container">
			<div class="content-page__text">
				<?php the_content(); ?>

				<?php echo zenit_catalog_button(); ?>
			</div>
			<?php echo zenit_sidebar(); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
