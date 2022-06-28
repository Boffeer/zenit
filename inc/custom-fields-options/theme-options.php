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
		Field::make('text', 'global_email', 'Email')
			->set_width(30),
		Field::make('textarea', 'global_address', 'Адрес')
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
		Field::make('radio', 'go_catalog_active', 'Отображать или скрывать')
			->add_options(array(
				true => __('Блок отображается'),
				false => __('Блок скрыт'),
			))
	));

Container::make('post_meta', 'page_info', 'Информация о странице')
	->where('post_type', '=', 'page')
	->add_tab('Page settings', array(
		Field::make('text', 'page_title', 'Заголовок'),
		Field::make('textarea', 'page_description', 'Описание'),
		Field::make('image', 'og_image', 'Картинка для соцсетей')
			->set_value_type('url'),
	));
