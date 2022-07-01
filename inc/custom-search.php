<?php

function my_cptui_add_post_type_to_search($query)
{
	if (is_admin()) {
		return;
	}

	if ($query->is_search()) {
		$cptui_post_types = array('news', 'products', 'product-category', 'page');
		$query->set(
			'post_type',
			array_merge(
				array('post'), // May also want to add the "page" post type.
				$cptui_post_types
			)
		);
		$query->set(
			'taxonomies',
			array_merge(
				array('post'), // May also want to add the "page" post type.
				$cptui_post_types
			)
		);
	}
}
// add_filter('pre_get_posts', 'my_cptui_add_post_type_to_search');
