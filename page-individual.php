<?php get_header(); ?>

<?php echo zenit_breadcrumbs(); ?>

<section class="content-page">
	<div class="container catalog-page">
		<h1>Каталог</h1>
		<button class="btn catalog-nav-btn">Открыть каталог</button>

		<div class="content-page__catalog">
			<div class="content-page__aside">
				<?php echo zenit_get_categories(); ?>
				<?php echo zenit_sidebar(array(
					'callback'
				)); ?>
			</div>

			<div class="content-page__wrapper catalog-content">
				<p class="catalog-content__text">
					<b>У Вас есть возможность заказать куттерные ножи по собственным
						размерам</b>
				</p>
				<ol class="catalog-content__list">
					<li>
						Для этого Вам необходимо загрузить файл с размерами в формате
						JPEG или PNG
					</li>
					<li>
						Указать номер телефона и наименование компании (желательно)
					</li>
					<li>Нажать кнопку «Отправить заявку»</li>
				</ol>

				<form action="#" method="POST" class="catalog-content__form">
					<label class="catalog-content__file field-file">
						<svg width="46" height="41" viewBox="0 0 46 41" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1.4375 26.5254C1.81875 26.5254 2.18438 26.6768 2.45397 26.9464C2.72355 27.216 2.875 27.5816 2.875 27.9629V35.1504C2.875 35.9129 3.1779 36.6442 3.71707 37.1833C4.25624 37.7225 4.9875 38.0254 5.75 38.0254H40.25C41.0125 38.0254 41.7438 37.7225 42.2829 37.1833C42.8221 36.6442 43.125 35.9129 43.125 35.1504V27.9629C43.125 27.5816 43.2765 27.216 43.546 26.9464C43.8156 26.6768 44.1813 26.5254 44.5625 26.5254C44.9437 26.5254 45.3094 26.6768 45.579 26.9464C45.8485 27.216 46 27.5816 46 27.9629V35.1504C46 36.6754 45.3942 38.1379 44.3159 39.2163C43.2375 40.2946 41.775 40.9004 40.25 40.9004H5.75C4.22501 40.9004 2.76247 40.2946 1.68414 39.2163C0.605802 38.1379 0 36.6754 0 35.1504V27.9629C0 27.5816 0.15145 27.216 0.421034 26.9464C0.690618 26.6768 1.05625 26.5254 1.4375 26.5254Z" fill="#222222" fill-opacity="0.7" />
							<path d="M21.9841 32.1427C22.1176 32.2766 22.2762 32.3828 22.4509 32.4553C22.6255 32.5278 22.8127 32.5651 23.0018 32.5651C23.1909 32.5651 23.3781 32.5278 23.5528 32.4553C23.7274 32.3828 23.886 32.2766 24.0196 32.1427L32.6446 23.5177C32.9145 23.2478 33.0661 22.8817 33.0661 22.5C33.0661 22.1183 32.9145 21.7522 32.6446 21.4823C32.3746 21.2123 32.0085 21.0607 31.6268 21.0607C31.2451 21.0607 30.879 21.2123 30.6091 21.4823L24.4393 27.6549V2.375C24.4393 1.99375 24.2879 1.62812 24.0183 1.35853C23.7487 1.08895 23.3831 0.9375 23.0018 0.9375C22.6206 0.9375 22.2549 1.08895 21.9854 1.35853C21.7158 1.62812 21.5643 1.99375 21.5643 2.375V27.6549L15.3946 21.4823C15.1246 21.2123 14.7585 21.0607 14.3768 21.0607C13.9951 21.0607 13.629 21.2123 13.3591 21.4823C13.0891 21.7522 12.9375 22.1183 12.9375 22.5C12.9375 22.8817 13.0891 23.2478 13.3591 23.5177L21.9841 32.1427Z" fill="#222222" fill-opacity="0.7" />
						</svg>
						<span class="field-file__placeholder">Перетащите файл сюда <br />
							или нажмите для загрузки</span>
						<small class="field-file__limitation">Файл не должен превышать размер 6 mb</small>
						<input type="file" name="file" class="_required validation-file" />
					</label>

					<div class="form-elem catalog-content__fields">
						<input class="catalog-content__input form-elem__area" type="text" name="company" placeholder="Компания" />
						<input class="catalog-content__input form-elem__area _required validation-input" type="tel" name="user_phone" placeholder="Номер телефона*" />
					</div>

					<div class="catalog-content__submit">
						<button class="btn" type="submit" data-submit>
							Отправить заявку
						</button>
						<p>
							Нажимая на кнопку «Отправить заявку» вы даете свое согласие
							на обработку <a href="<?php echo get_privacy_policy_url(); ?>">персональных данных</a>
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
