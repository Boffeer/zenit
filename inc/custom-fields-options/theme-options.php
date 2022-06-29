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
						'type'      => 'post',
						'post_type' => 'post',
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

Container::make('post_meta', 'page_info', 'Информация о странице')
	->where('post_type', '=', 'page')
	->add_tab('Настройки страницы', array(
		Field::make('text', 'page_title', 'Заголовок'),
		Field::make('textarea', 'page_description', 'Описание'),
		Field::make('image', 'og_image', 'Картинка для соцсетей')
			->set_value_type('url'),
	));
