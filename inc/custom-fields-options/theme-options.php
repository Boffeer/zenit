<?php
if (!defined('ABSPATH')) {
	exit; // exit if accessed directly
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Default options page
$basic_options_container = Container::make('theme_options', 'i3d_theme_settings',  'Глобальные настройки')
	->add_tab('Телефоны и адреса', array(
		Field::make('text', 'global_phone', 'Телефон')
			->set_width(30),
		Field::make('text', 'global_fax', 'Телефон/Факс')
			->set_width(30),
		Field::make('text', 'global_email', 'Email')
			->set_width(30),
		Field::make('text', 'global_instagram', 'Instagram')
			->set_width(30),
		Field::make('textarea', 'global_address', 'Адрес')
			->set_width(30),
		Field::make('textarea', 'global_address_full', 'Адрес полный')
			->set_width(30),
		Field::make('textarea', 'global_address_ym', 'Яндекс карты')
			->set_width(30),
		Field::make('textarea', 'leads_email', 'Почты для заявок')
			->set_width(30),
	))
	->add_tab('Блок скачать каталог', array(
		Field::make('file', 'catalog_pdf', 'PDF Файл')
			->set_value_type('url'),
		Field::make('radio', 'catalog_active', 'Отображать или скрывать')
			->add_options(array(
				true => __('Блок отображается'),
				false => __('Блок скрыт'),
			)),
	))
	->add_tab('Блок консультация', array(
		Field::make('radio', 'consult_active', 'Отображать или скрывать')
			->add_options(array(
				true => __('Блок отображается'),
				false => __('Блок скрыт'),
			))
	))
	->add_tab('Блок перейти в каталог', array(
		Field::make('radio', 'go_catalog_active', __('Отображать или скрывать'))
			->add_options(array(
				true => __('Блок отображается'),
				false => __('Блок скрыт'),
			))
	));

Container::make('post_meta', 'page_info', __('Информация о странице'))
	->where('post_id', '=', '7')
	->add_tab(
		'Слайдер',
		array(
			Field::make('complex', 'banner_top', 'Слайдер')
				->add_fields(
					array(
						Field::make('image', 'img', 'Слайд')
							->set_value_type('url'),
						Field::make('textarea', 'text', 'Тексты')
					)
				)
		)
	)
	->add_tab(
		'Преимущества',
		array(
			Field::make('complex', 'features', 'Преимущества')
				->add_fields(
					array(
						Field::make('image', 'icon', 'Иконка')
							->set_value_type('url'),
						Field::make('textarea', 'texts', 'Тексты')
							->set_help_text('Строки отделять через enter. Строки идут последовательно как в компьютерной версии сайта.'),
					)
				)
		)
	)
	->add_tab(
		'Каталог',
		array(
			Field::make('association', 'main_catalog', __('Каталог'))
				->set_types(array(
					array(
						'type'      => 'term',
						'taxonomy' => 'product-category',
					)
				))
		)
	)
	->add_tab(
		'Форма обратной связи',
		array(
			Field::make('textarea', 'form_text', 'Тексты формы')
				->set_help_text('Строки отделять через enter. Строки идут последовательно как в компьютерной версии сайта. 2 энетера, чтобы сделать разрыв строки'),
		)
	)
	->add_tab(
		'О компании',
		array(
			Field::make('rich_text', 'about_text', __('Тексты формы')),
		)
	);

Container::make('post_meta', 'page_info', 'О новости')
	->where('post_type', '=', 'news')
	->add_fields(
		array(
			Field::make('media_gallery', 'news_slider', 'Слайдер новости')
		)
	);

Container::make('post_meta', 'page_info', 'Вакансия')
	->where('post_type', '=', 'jobs')
	->add_fields(
		array(
			Field::make('text', 'location', 'Где')
				->set_default_value('г. Воронеж'),
			Field::make('complex', 'desc', 'Описание')
				->add_fields(array(
					Field::make('text', 'title', 'Заголовок'),
					Field::make('textarea', 'desc', 'Тексты')
				))
				->set_default_value(array(
					array(
						'title' => 'Требования к соискателю',
					),
					array(
						'title' => 'Основнвые обязонности',
					),
					array(
						'title' => 'Условия работы',
					),
				)),
		)
	);


Container::make('post_meta', 'product_info', 'О товаре')
	->where('post_type', '=', 'products')
	->add_fields(array(
		Field::make('textarea', 'stats', 'Тексты'),
		Field::make('media_gallery', 'thumbs', 'Фото'),
		Field::make('complex', 'files', 'Файлы')
			->add_fields(
				array(
					Field::make('text', 'filename', 'Файл'),
					Field::make('file', 'file', 'Файл')
						->set_value_type('url'),
				)
			)
	));

Container::make('post_meta', 'review_info', 'Отзыв')
	->where('post_type', '=', 'reviews')
	->add_fields(array(
		Field::make('textarea', 'subtitle', 'Подзаголовок'),
		Field::make('textarea', 'review', 'Отзыв'),
	));

Container::make('post_meta', 'certificates_info', 'Сертификаты')
	->where('post_type', '=', 'certificates')
	->add_fields(array(
		Field::make('image', 'photo', 'Фото')
			->set_value_type('url'),
		Field::make('textarea', 'cert_desc', 'Описание'),
	));
