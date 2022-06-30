<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zenit
 */

get_header();
?>

<?php echo zenit_breadcrumbs(); ?>

<section class="content-page catalog-detail-page">
	<div class="container">
		<h1><?php the_title(); ?></h1>
		<div class="content-page__container">
			<div class="catalog-detail">
				<div class="catalog-detail__header">
					<div class="catalog-detail__gallary">
						<div class="catalog-detail-main"></div>

						<div class="catalog-detail-slider">
							<div class="swiper">
								<div class="swiper-wrapper">
									<img data-skip-lazy class="swiper-slide catalog-detail-slider__item catalog-detail-slider__item--active" src="<?php echo esc_url((wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0])) ?>" alt="<?php the_title(); ?>" />
									<?php $thumbs = carbon_get_post_meta(get_the_id(), 'thumbs'); ?>
									<?php foreach ($thumbs as $thumb) : ?>
										<img data-skip-lazy class="swiper-slide catalog-detail-slider__item" src="<?php echo esc_url((wp_get_attachment_image_src($thumb, 'full')[0])) ?>" alt="<?php the_title(); ?>" />
									<?php endforeach ?>
								</div>
							</div>
							<div class="catalog-detail-slider__arrows">
								<div class="swiper__arrow-prev">
									<svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11 21L1 11L11 1" stroke="#222222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</div>
								<div class="swiper__arrow-next">
									<svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1 21L11 11L1 1" stroke="#222222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</div>
							</div>
						</div>
					</div>
					<div class="catalog-detail__text">
						<p>
							<?php echo nl2br(get_the_excerpt()); ?>
						</p>
					</div>
				</div>

				<div class="catalog-detail__tabs tabs">
					<div class="tabs__header">
						<div class="swiper tabs-slider">
							<div class="swiper-wrapper">
								<a class="tab-link tab-link--active swiper-slide">Описание</a>
								<a class="tab-link swiper-slide">Технические характеристики</a>
								<a class="tab-link swiper-slide">Материалы для скачивания</a>
							</div>
						</div>
					</div>

					<div class="tabs__main">
						<div class="swiper">
							<div class="swiper-wrapper">
								<div class="swiper-slide catalog-detail__tab tab">
									<div class="tab__wrapper">
										<?php the_content(); ?>
									</div>
								</div>
								<div class="swiper-slide catalog-detail__tab tab">
									<div class="tab__wrapper">
										<table class="catalog-detail__table">
											<?php $stats = boffeer_explode_double_nl(carbon_get_post_meta(get_the_id(), 'stats'));  ?>
											<tr>
												<th>Характеристика</th>
												<th>Размерность</th>
												<th>Величина</th>
											</tr>
											<?php foreach ($stats as $row) : ?>
												<tr>
													<?php foreach ($row as $cell) : ?>
														<td><?php echo $cell ?></td>
													<?php endforeach ?>
												</tr>
											<?php endforeach ?>
										</table>
									</div>
								</div>
								<div class="swiper-slide catalog-detail__tab tab">
									<div class="tab__wrapper">
										<ul class="catalog-detail-list">
											<?php $files = carbon_get_post_meta(get_the_id(), 'files'); ?>
											<?php foreach ($files as $file) : ?>
												<li class="catalog-detail-list__item">
													<p class="catalog-detail-list__text">
														<?php echo $file['filename']; ?>
													</p>
													<a href="<?php echo $file['file'] ?>">Скачать
														<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M2.22222 14.1667H0.444444C0.32657 14.1667 0.213524 14.2106 0.130175 14.2887C0.0468253 14.3668 0 14.4728 0 14.5833V19.5833C0 19.6938 0.0468253 19.7998 0.130175 19.878C0.213524 19.9561 0.32657 20 0.444444 20C0.562318 20 0.675364 19.9561 0.758714 19.878C0.842063 19.7998 0.888889 19.6938 0.888889 19.5833V18.3333H2.22222C2.81159 18.3333 3.37682 18.1138 3.79357 17.7231C4.21032 17.3324 4.44444 16.8025 4.44444 16.25C4.44444 15.6975 4.21032 15.1676 3.79357 14.7769C3.37682 14.3862 2.81159 14.1667 2.22222 14.1667ZM2.22222 17.5H0.888889V15H2.22222C2.57584 15 2.91498 15.1317 3.16503 15.3661C3.41508 15.6005 3.55556 15.9185 3.55556 16.25C3.55556 16.5815 3.41508 16.8995 3.16503 17.1339C2.91498 17.3683 2.57584 17.5 2.22222 17.5ZM12 14.5833V19.5833C11.9988 19.6701 11.9694 19.7544 11.9158 19.8251C11.8623 19.8958 11.787 19.9496 11.7 19.9792L11.5556 20C11.4869 19.9985 11.4194 19.9827 11.3579 19.9539C11.2964 19.9251 11.2425 19.8839 11.2 19.8333L8 15.8333V19.5833C8 19.6938 7.95317 19.7998 7.86982 19.878C7.78648 19.9561 7.67343 20 7.55556 20C7.43768 20 7.32463 19.9561 7.24129 19.878C7.15794 19.7998 7.11111 19.6938 7.11111 19.5833V14.5833C7.11232 14.4966 7.14168 14.4123 7.19527 14.3416C7.24886 14.2709 7.32414 14.2171 7.41111 14.1875C7.50019 14.1591 7.5966 14.1578 7.68645 14.1841C7.77631 14.2103 7.85497 14.2625 7.91111 14.3333L11.1111 18.3333V14.5833C11.1111 14.4728 11.1579 14.3668 11.2413 14.2887C11.3246 14.2106 11.4377 14.1667 11.5556 14.1667C11.6734 14.1667 11.7865 14.2106 11.8698 14.2887C11.9532 14.3668 12 14.4728 12 14.5833ZM20 18.5208C20.0002 18.6015 19.9771 18.6806 19.9333 18.75C19.6796 19.1277 19.3291 19.4399 18.9138 19.6582C18.4985 19.8765 18.0316 19.994 17.5556 20C15.9667 20 14.6667 18.6875 14.6667 17.0833C14.6667 15.4792 15.9667 14.1667 17.5556 14.1667C18.1255 14.1672 18.6811 14.3347 19.1444 14.6458C19.2399 14.7107 19.3047 14.8077 19.3255 14.9165C19.3462 15.0253 19.3211 15.1373 19.2556 15.2292C19.2214 15.2737 19.1781 15.3115 19.1283 15.3404C19.0785 15.3693 19.0231 15.3886 18.9652 15.3973C18.9074 15.406 18.8483 15.4039 18.7914 15.3912C18.7344 15.3784 18.6807 15.3552 18.6333 15.3229C18.3171 15.1158 17.9413 15.0032 17.5556 15C16.4556 15 15.5556 15.9375 15.5556 17.0833C15.5556 18.2292 16.4556 19.1667 17.5556 19.1667C17.861 19.161 18.1609 19.0884 18.431 18.9545C18.7012 18.8207 18.9341 18.6293 19.1111 18.3958V17.7083H18.2222C18.1043 17.7083 17.9913 17.6644 17.908 17.5863C17.8246 17.5082 17.7778 17.4022 17.7778 17.2917C17.7778 17.1812 17.8246 17.0752 17.908 16.997C17.9913 16.9189 18.1043 16.875 18.2222 16.875H19.5556C19.6734 16.875 19.7865 16.9189 19.8698 16.997C19.9532 17.0752 20 17.1812 20 17.2917V18.5208ZM18.2222 10.4167C18.2222 10.5272 18.269 10.6332 18.3524 10.7113C18.4357 10.7894 18.5488 10.8333 18.6667 10.8333C18.7845 10.8333 18.8976 10.7894 18.9809 10.7113C19.0643 10.6332 19.1111 10.5272 19.1111 10.4167V6.26043C19.1068 6.14799 19.0595 6.04077 18.9778 5.95834L12.7556 0.13543C12.7177 0.0926417 12.6701 0.0582927 12.6163 0.0348715C12.5625 0.0114504 12.5038 -0.000456532 12.4444 1.33872e-05H1.77778C1.42416 1.33872e-05 1.08502 0.131709 0.834969 0.36613C0.58492 0.60055 0.444444 0.918492 0.444444 1.25001V10.4167C0.444444 10.5272 0.49127 10.6332 0.574619 10.7113C0.657969 10.7894 0.771015 10.8333 0.888889 10.8333C1.00676 10.8333 1.11981 10.7894 1.20316 10.7113C1.28651 10.6332 1.33333 10.5272 1.33333 10.4167V1.25001C1.33333 1.13951 1.38016 1.03353 1.46351 0.955385C1.54686 0.877245 1.6599 0.833346 1.77778 0.833346H12V6.25001C12 6.36052 12.0468 6.4665 12.1302 6.54464C12.2135 6.62278 12.3266 6.66668 12.4444 6.66668H18.2222V10.4167ZM12.8889 1.4271L17.5889 5.83334H12.8889V1.4271Z" fill="#222222" />
														</svg>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- <a class="btn catalog-detail__back" href="#">Вернуться в каталог</a> -->
				<?php echo zenit_catalog_button(
					array(
						'classlist' => 'catalog-detail__back',
						'text' => 'Вернуться в каталог',
					)
				); ?>
			</div>

			<?php echo zenit_sidebar(array(
				'catalog'
			)); ?>
		</div>
	</div>
</section>

<?php
get_footer();
