<?php get_header(); ?>

<?php
$contacts = zenit_get_contacts();
?>

<?php echo zenit_breadcrumbs(); ?>

<section class="contacts-page">
	<div class="container">
		<h1 class="contacts-page__title"><?php the_title(); ?></h1>
		<div class="contacts-page__content">
			<div class="contacts-page__address">
				<p class="contacts-page__address-text">
					<span class="bold">Адрес:</span> <?php echo $contacts['address_full']; ?>
				</p>
				<p class="contacts-page__address-text">
					<span class="bold">Телефон:</span>
					<a class="contacts-page__address-link" href="<?php echo $contacts['phone_href']; ?>"><?php echo $contacts['phone']; ?></a>
				</p>
				<p class="contacts-page__address-text">
					<span class="bold">Телефон/факс:</span>
					<a class="contacts-page__address-link" href="<?php $contacts['fax_href']; ?>"><?php echo $contacts['fax']; ?></a>
				</p>
				<p class="contacts-page__address-text">
					<span class="bold">Email:</span>
					<a class="contacts-page__address-link" href="mailto:<?php echo $contacts['email'] ?>"><?php echo $contacts['email'] ?></a>
				</p>
				<p class="contacts-page__address-text">
					<span class="bold">Instagramm:</span>
					<a class="contacts-page__address-link" href="https://www.instagram.com/<?php echo $contacts['instagram']; ?>"><?php echo $contacts['instagram'] ?></a>
				</p>
			</div>
			<div class="contacts-page__callback block_choose">
				<p class="block_choose__title">Необходимо перезвонить?</p>
				<form class="block_choose__form">
					<div class="form-elem">
						<input class="form-elem__area _required" type="tel" placeholder="Номер телефона *" required />
					</div>
					<button class="btn block_choose__submit" type="submit">
						Жду звонка
					</button>
				</form>
			</div>
			<iframe class="contacts-page__map" src="<?php echo carbon_get_theme_option('global_address_ym'); ?>"></iframe>
		</div>
		<?php echo zenit_catalog_button(); ?>
	</div>
</section>

<?php get_footer(); ?>
