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
	<ul class="breadcrumbs-list">
		<li class="breadcrumbs-list__element">
			<a href="">Путь:</a>
		</li>
		<li class="breadcrumbs-list__element">
			<a href="">Главная</a>
		</li>
		<li class="breadcrumbs-list__element">
			<a href="">Каталог</a>
		</li>
		<li class="breadcrumbs-list__element">
			<a href="">Фаршемешалка Л5 ФМ2 У 335 МР</a>
		</li>
	</ul>
</div>
