<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zenit
 */

?>


<footer class="footer">
	<div class="footer_top_menu">
		<div class="container fl-align">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="" class="footer_logo" />
			<ul class="footer_menu fl-align">
				<?php
				$footer_menu_id = 4;
				$footer_menu_items =  wp_get_nav_menu_items($footer_menu_id, [
					'output_key'  => 'menu_order',
				]);
				?>
				<li class="footer_menu__line">
					<a href="">Главная</a>
				</li>
				<li class="footer_menu__line">
					<a href="">Каталог</a>
				</li>
				<li class="footer_menu__line">
					<a href="">О компании</a>
				</li>
				<li class="footer_menu__line">
					<a href="">Дилерам</a>
				</li>
				<li class="footer_menu__line">
					<a href="">Техническая поддержка</a>
				</li>
				<li class="footer_menu__line">
					<a href="">Контакты</a>
				</li>
			</ul>
			<a href="tel:8(800)775-63-84" class="footer_phone">8 (800) 775-63-84</a>
			<button class="footer_btn btn">Заказать звонок</button>
			<div class="footer_scroll_top">
				<svg>
					<use href="<?php echo get_stylesheet_directory_uri(); ?>/img/sprite.svg#arr-top"></use>
				</svg>
			</div>
		</div>
	</div>
	<div class="footer_bottom_line">
		<div class="container fl-align">
			<p class="footer_bottom_line__copyright">
				© ООО «Зенит» Все права защищены 2022
			</p>
			<a href="" class="footer_bottom_line__policy">
				Политика обработки персональных данных
			</a>
			<a href="" class="footer_bottom_line__study">
				Дизайн и разработка сайта: <strong>ГК «ТВИМ»</strong>
			</a>
		</div>
	</div>
</footer>
</div>

<!-- Модальные окна -->
<div class="modal" id="consultation">
	<div class="modal__body">
		<div class="modal__content">
			<h2 class="modal__title">Оставьте заявку</h2>
			<p class="modal__text">
				И наш менеджер свяжется с Вами<br />
				в ближайшее время
			</p>
			<form action="#" method="POST" class="form modal__form" id="modal__form">
				<div class="form-elem">
					<input class="form-elem__area validation-input" type="tel" id="user_phone" name="user_phone" placeholder="Номер телефона*" data-placeholder="Номер телефона*" />
				</div>
				<button class="btn modal__submit" type="submit" data-submit>
					Жду звонка
				</button>
				<span class="modal__attention">Нажимая на кнопку «Жду звонка» вы даете свое<br />
					согласие на обработку <a href="">персональных данных</a></span>
			</form>
			<button class="modal__close">
				<span></span>
				<span></span>
			</button>
		</div>
	</div>
</div>

<div class="modal" id="thanks">
	<div class="modal__body">
		<div class="modal__content">
			<h2 class="modal__title">Ваша заявка принята</h2>
			<p class="modal__text">
				В ближайшее время с Вами<br />
				свяжется наш менеджер
			</p>
			<p class="modal__text modal__text-next">Хорошего Вам дня!</p>
			<button class="modal__close btn">Закрыть</button>
		</div>
	</div>
</div>

<div class="modal" id="otzyv">
	<div class="modal__body">
		<div class="modal__content">
			<h2 class="modal__title">Оставить отзыв</h2>
			<form action="#" method="POST" class="form modal__form" id="modal__form-2">
				<div class="form-elem">
					<input class="form-elem__area validation-input" type="text" id="user_name" name="name" placeholder="Ваше имя*" data-placeholder="Ваше имя*" />
				</div>
				<div class="form-elem">
					<input class="form-elem__area validation-input" type="text" id="user_company" name="company" data-placeholder="Город и наименование организации*" placeholder="Город и наименование организации*" />
				</div>
				<div class="form-elem">
					<textarea class="form-elem__area validation-input" id="user_message" name="message" maxlength="270" data-placeholder="Текст отзыва (не более 270 символов)" placeholder="Текст отзыва (не более 270 символов)"></textarea>
				</div>
				<button class="btn modal__submit" type="submit" data-submit>
					Оставить отзыв
				</button>
			</form>
			<button class="modal__close">
				<span></span>
				<span></span>
			</button>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>

</html>
