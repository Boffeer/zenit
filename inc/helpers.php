<?php

if (!function_exists('i3d_explode_tinymc')) :
	/**
	 * All Enter transform to new bullet
	 * All Shift + Enter transform to <br> of bullet
	 */
	function i3d_explode_tinymc($input)
	{
		$shift_enter = explode("\r\n\r\n", $input);
		return array_map('nl2br', $shift_enter);
	}
endif;
if (!function_exists('i3d_explode_textarea')) :
	/**
	 * Transform textarea saved as string to array where every new line is a item of the array
	 */
	function i3d_explode_textarea($input)
	{
		return explode("\n", str_replace("\r", "", $input));
	}
endif;

if (!function_exists('i3d_get_word_form')) :
	/**
	 * Returns a correct form of the word
	 * 1 Item, but 5 Items
	 */
	function i3d_get_word_form($count, $words)
	{
		if ($count > 1) {
			return "{$count} {$words['1']}";
		} else {
			return "{$count} {$words['0']}";
		}
	}
endif;


if (!function_exists('i3d_setup_crb_posts')) :
	/**
	 * Prints crb assosiation posts
	 */
	function i3d_the_crb_posts($posts, $count = -1)
	{
		$include_ids = array();
		$post_type = null;
		foreach ($posts as $item) {
			$include_ids[] = $item['id'];
			if (!$post_type) {
				$post_type = $item['subtype'];
			}
		}

		global $post;
		$posts = get_posts(array(
			'numberposts' => $count,
			'post_type'   => $post_type,
			'include' => $include_ids,
			'suppress_filters' => true,
		));

		foreach ($posts as $post) :
			setup_postdata($post);
			get_template_part('template-parts/content', $post->post_type);
		endforeach;
		wp_reset_postdata();
	}
endif;
