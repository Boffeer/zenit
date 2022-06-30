<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package zenit
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function zenit_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'zenit_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function zenit_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'zenit_pingback_header');

function zenit_custom_pagination($nav)
{
	$search  = [
		'<nav class="navigation pagination" role="navigation">',
		'<div class="nav-links">',
		'</div>',
		'<a class="page-numbers"',
		'<a class="prev page-numbers"',
		'<a class="next page-numbers"',
		'<span aria-current="page" class="page-numbers current"',
		'<span class="page-numbers dots">',
	];
	$replace = [
		'<nav>',
		'<div class="icons-list__pagination flex pagination">',
		'</div>',
		'<a class="pagination__list-element"',
		'<a class="pagination-prev"',
		'<a class="pagination-next"',
		'<span aria-current="page" class="pagination__list-element _active"',
		'<span class="pagination__list-element">',
	];

	$nav  = str_replace($search, $replace, $nav);
	return $nav;
}

function zenit_get_pagination()
{
	global $paged;
	// global $query;
	$paged = max($paged, 1);
	$per_page = 10;
	$total = ceil($query->found_posts / $paged);
	$args = array(
		// 'total'        => 1,
		// 'current'      => $paged,
		'prev_text'    => '<svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M11 21L1 11L11 1" stroke="#222222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /> </svg>',
		'next_text'    => '<svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M1 21L11 11L1 1" stroke="#222222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /> </svg>',


	);
	$pagination = zenit_custom_pagination(paginate_links($args));
	ob_start();
?>
	<div class="pagination fl-align">
		<?php print($pagination); ?>
	</div>
<?php
	return ob_get_clean();
}
