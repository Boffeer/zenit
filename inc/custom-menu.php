<?php
class True_Walker_Nav_Menu extends Walker_Nav_Menu
{
	/*
	 * Позволяет перезаписать <ul class="sub-menu">
	 */
	function start_lvl(&$output, $depth = 0, $args = NULL)
	{
		$output .= '<ul class="header-all__bottom__list-children depth-' . $depth . '">';
	}
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output
	 * @param object $item Объект элемента меню, подробнее ниже.
	 * @param int $depth Уровень вложенности элемента меню.
	 * @param object $args Параметры функции wp_nav_menu
	 */
	function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0)
	{
		// для WordPress 5.3+
		// function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 ) {
		global $wp_query;
		/*
		 * Некоторые из параметров объекта $item
		 * ID - ID самого элемента меню, а не объекта на который он ссылается
		 * menu_item_parent - ID родительского элемента меню
		 * classes - массив классов элемента меню
		 * post_date - дата добавления
		 * post_modified - дата последнего изменения
		 * post_author - ID пользователя, добавившего этот элемент меню
		 * title - заголовок элемента меню
		 * url - ссылка
		 * attr_title - HTML-атрибут title ссылки
		 * xfn - атрибут rel
		 * target - атрибут target
		 * current - равен 1, если является текущим элементом
		 * current_item_ancestor - равен 1, если текущим (открытым на сайте) является вложенный элемент данного
		 * current_item_parent - равен 1, если текущим (открытым на сайте) является родительский элемент данного
		 * menu_order - порядок в меню
		 * object_id - ID объекта меню
		 * type - тип объекта меню (таксономия, пост, произвольно)
		 * object - какая это таксономия / какой тип поста (page /category / post_tag и т д)
		 * type_label - название данного типа с локализацией (Рубрика, Страница)
		 * post_parent - ID родительского поста / категории
		 * post_title - заголовок, который был у поста, когда он был добавлен в меню
		 * post_name - ярлык, который был у поста при его добавлении в меню
		 */
		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		/*
		 * Генерируем строку с CSS-классами элемента меню
		 */
		$class_names = $value = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;

		if ($depth == 0) {
			$classes[] = 'dropdown fl-align header-all__bottom__list menu-item-' . $item->ID . 'depth-' . $depth;
		} else if ($depth == 1) {
			$classes[] = 'header-all__bottom__list menu-item-' . $item->ID . 'depth-' . $depth;
		} else if ($depth == 2) {
			$classes[] = 'header-all__bottom__list menu-item-' . $item->ID . 'depth-' . $depth;
		} else {
			$classes[] = 'header-all__bottom__list menu-item-' . $item->ID . 'depth-' . $depth;
		}

		// функция join превращает массив в строку
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class="' . esc_attr($class_names) . '"';

		/*
		 * Генерируем ID элемента
		 */
		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

		/*
		 * Генерируем элемент меню
		 */
		$output .= $indent . '<li' . $id . $value . $class_names . '>';

		// атрибуты элемента, title="", rel="", target="" и href=""
		$attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"' : '';
		$attributes .= 'class="header-all__bottom__list-link"';

		// ссылка и околоссылочный текст
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}

add_filter('wp_nav_menu', 'zenit_nav_menu', 20);
function zenit_nav_menu($output)
{
	$search  = [
		'<ul id=',
		'</ul></il>',
		'depth-1',
	];
	$replace = [
		'<ul class="header-all__bottom-menu fl-align" id=',
		'</ul><svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M5.5 9L0 0L11 9.08524e-07L5.5 9Z" fill="#222222"></path> </svg></il>',
		'depth-1 dropdown'

	];

	// return str_replace($search, $replace, $output);
	return $output;
}

function wp_get_menu_array($current_menu)
{
	$array_menu = wp_get_nav_menu_items($current_menu);
	$menu = array();
	foreach ($array_menu as $m) {
		if (empty($m->menu_item_parent)) {
			$menu[$m->ID] = array();
			$menu[$m->ID]['ID']          =   $m->ID;
			$menu[$m->ID]['title']       =   $m->title;
			$menu[$m->ID]['url']         =   $m->url;
			$menu[$m->ID]['children']    =   array();
		}
	}
	$submenu = array();
	foreach ($array_menu as $m) {
		if ($m->menu_item_parent) {
			$submenu[$m->ID] = array();
			$submenu[$m->ID]['ID']       =   $m->ID;
			$submenu[$m->ID]['title']    =   $m->title;
			$submenu[$m->ID]['url']      =   $m->url;
			$menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
		}
	}
	return $menu;
}


function is_menu_child($current_id, $parent_id)
{
	return $current_id == $parent_id;
}
