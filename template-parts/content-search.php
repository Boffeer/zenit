<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zenit
 */

?>

<a id="post-<?php the_ID(); ?>" href="<?php the_permalink($post->ID) ?>" class="search-page__content">
	<p class="search-page__text">
		<?php echo str_replace(get_search_query(), '<span class="word">' . get_search_query() . '</span>', $post->post_title); ?>
	</p>
</a>
<div class="breadcrumbs search-page__breadcrumbs">
	<?php
	$search_breadcrumbs = array();
	// Если термы это категории товара, то бредкрамбов не буедт
	// Если термы страницы, то бредкрамбов не будет
	// Если термы новости — то будет архив
	// А если термы это товар, то будет категория товара
	// foreach ($posts as $search) {
	$taxes = get_post_taxonomies($post->ID);
	$term_url = home_url('/');
	if (in_array('product-category', $taxes)) {
		$term_url .= 'product-category';
		$term_name = get_taxonomy('product-category')->label;
	} elseif (in_array('post_tag', $taxes)) {
		$term_url .= 'news';
		$term_name = get_post_type_object('news')->label;
	} else {
		unset($term_name);
		$term_url = false;
	}
	?>
	<ul class="breadcrumbs-list">
		<li class="breadcrumbs-list__element">
			<span>Путь:</span>
		</li>
		<li class="breadcrumbs-list__element">
			<a href="<?php echo home_url('/'); ?>">Главная</a>
		</li>
		<?php if ($term_url) : ?>
			<li class="breadcrumbs-list__element">
				<a href="<?php echo $term_url; ?>"><?php echo $term_name; ?></a>
			</li>
		<?php endif; ?>
		<li class="breadcrumbs-list__element">
			<a href="<?php the_permalink($post->ID); ?>"><?php the_title(); ?></a>
		</li>
	</ul>
	<?php
	echo '<pre>';
	// var_dump($search_breadcrumbs);
	// var_dump($taxes);
	echo '</pre>';
	?>
</div>
