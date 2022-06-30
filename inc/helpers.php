<?php

if (!function_exists('boffeer_explode_double_nl')) :
	/**
	 * All Enter transform to new bullet
	 * All Shift + Enter transform to <br> of bullet
	 */
	function boffeer_explode_double_nl($input)
	{
		$shift_enter = explode("\r\n\r\n", $input);
		foreach ($shift_enter as $key => $row) {
			$shift_enter[$key] = explode("\n", str_replace("\r", "", $row));
		}
		return $shift_enter;
	}
endif;

if (!function_exists('boffeer_explode_tinymc')) :
	/**
	 * All Enter transform to new bullet
	 * All Shift + Enter transform to <br> of bullet
	 */
	function boffeer_explode_tinymc($input)
	{
		$shift_enter = explode("\r\n\r\n", $input);
		return array_map('nl2br', $shift_enter);
	}
endif;
if (!function_exists('boffeer_explode_textarea')) :
	/**
	 * Transform textarea saved as string to array where every new line is a item of the array
	 */
	function boffeer_explode_textarea($input)
	{
		return explode("\n", str_replace("\r", "", $input));
	}
endif;

if (!function_exists('boffeer_get_word_form')) :
	/**
	 * Returns a correct form of the word
	 * 1 Item, but 5 Items
	 */
	function boffeer_get_word_form($count, $words)
	{
		if ($count > 1) {
			return "{$count} {$words['1']}";
		} else {
			return "{$count} {$words['0']}";
		}
	}
endif;


if (!function_exists('boffeer_setup_crb_posts')) :
	/**
	 * Prints crb assosiation posts
	 */
	function boffeer_the_crb_posts($posts, $count = -1)
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

if (!function_exists('zenit_get_contacts')) :
	function zenit_get_contacts()
	{
		$page_contacts_id = 24;
		$page_about_id = 20;
		return array(
			'phone' => carbon_get_theme_option('global_phone'),
			'phone_href' => 'tel:' . preg_replace('/\D/i', '', carbon_get_theme_option('global_phone')),
			'fax' => carbon_get_theme_option('global_fax'),
			'fax_href' => 'tel:' . preg_replace('/\D/i', '', carbon_get_theme_option('global_fax')),
			'instagram' => carbon_get_theme_option('global_instagram'),
			'address' => carbon_get_theme_option('global_address'),
			'address_full' => carbon_get_theme_option('global_address_full'),
			'email' => carbon_get_theme_option('global_email'),
			'contacts_url' => get_permalink($page_contacts_id),
			'contacts_title' => get_the_title($page_contacts_id),
			'about_url' => get_permalink($page_about_id),
			'about_title' => get_the_title($page_about_id),
		);
	}
endif;

function the_truncated_post($symbol_amount = 100)
{
	$filtered = strip_tags(preg_replace('@<style[^>]*?>.*?</style>@si', '', preg_replace('@<script[^>]*?>.*?</script>@si', '', apply_filters('the_content', get_the_content()))));
	return substr($filtered, 0, strrpos(substr($filtered, 0, $symbol_amount), ' ')) . '...';
}
