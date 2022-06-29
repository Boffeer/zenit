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

				<?php if (carbon_get_theme_option('go_catalog_active') && $page_id != 3) : ?>
					<a href="" class="content-page__text__btn btn">Перейти в каталог</a>
				<?php endif; ?>
			</div>
			<div class="content-page__block">
				<?php if (carbon_get_theme_option('catalog_active')) : ?>
					<div class="block_catalog">
						<h2 class="block_catalog__title">
							Каталог<br />
							«ЗЕНИТ»
						</h2>
						<a download="" href="<?php echo carbon_get_theme_option('catalog_pdf'); ?>" class="block_catalog__btn btn fl-align">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/pdf.png" alt="Скачать каталог" /> Скачать каталог
							PDF</a>
					</div>
				<?php endif; ?>
				<?php if (carbon_get_theme_option('consult_active')) : ?>
					<div class="consultant_block">
						<h2 class="consultant_block__title">Нужна консультация?</h2>
						<div class="consultant_block__info">
							Телефон: <a href="<?php echo $contacts['phone_href'] ?>"><?php echo $contacts['phone']; ?></a>
						</div>
						<div class="consultant_block__info">
							Email:
							<a href="mailto:<?php echo $contacts['email']; ?>"><?php echo $contacts['email']; ?></a>
						</div>
						<div class="consultant_block__info">
							<?php echo nl2br($contacts['address']); ?>
						</div>
						<a href="<?php echo $contacts['contacts_url']; ?>" class="consultant_block__link"><?php echo $contacts['contacts_title']; ?></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
