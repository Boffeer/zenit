<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package zenit
 */

if (!function_exists('zenit_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function zenit_posted_on()
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x('Posted on %s', 'post date', 'zenit'),
			'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('zenit_posted_by')) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function zenit_posted_by()
	{
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('by %s', 'post author', 'zenit'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('zenit_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function zenit_entry_footer()
	{
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'zenit'));
			if ($categories_list) {
				/* translators: 1: list of categories. */
				printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'zenit') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'zenit'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'zenit') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'zenit'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="screen-reader-text">%s</span>', 'zenit'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if (!function_exists('zenit_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function zenit_post_thumbnail()
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		if (is_singular()) :
?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

	<?php
		endif; // End is_singular().
	}
endif;

if (!function_exists('wp_body_open')) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
endif;

add_filter('get_search_form', 'i3d_search_form');
function i3d_search_form($form)
{
	ob_start(); ?>
	<form class="header-all__bottom__search fl-align" data-search action="<?php echo home_url('/'); ?>">
		<svg>
			<use href="<?php echo get_stylesheet_directory_uri(); ?>/img/sprite.svg#search"></use>
		</svg>
		<input type="search" class="search-input" placeholder="Поиск" name="s" />
		<span class="search-esc">
			<svg>
				<use href="<?php echo get_stylesheet_directory_uri(); ?>/img/sprite.svg#esc"></use>
			</svg>
		</span>
	</form>
<?php
	$form = ob_get_clean();
	return $form;
}

function zenit_catalog_button()
{
	ob_start();
?>
	<?php if (carbon_get_theme_option('go_catalog_active') && $page_id != 3) : ?>
		<a class="contacts-page__btn btn">Перейти в каталог</a>
	<?php endif; ?>
<?php
	return ob_get_clean();
}


function zenit_sidebar()
{
	$contacts = zenit_get_contacts();
	ob_start(); ?>
	<div class="content-page__block">
		<?php if (carbon_get_theme_option('catalog_active')) : ?>
			<div class="block_catalog">
				<h2 class="block_catalog__title">
					Каталог<br />
					«ЗЕНИТ»
				</h2>
				<a download="" href="<?php echo carbon_get_theme_option('catalog_pdf'); ?>" class="block_catalog__btn btn fl-align">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/pdf.png" alt="Скачать каталог" /> Скачать каталог
					PDF</a>
			</div>
		<?php endif; ?>
		<?php if (carbon_get_theme_option('consult_active')) : ?>
			<div class="consultant_block">
				<h2 class="consultant_block__title">Нужна консультация?</h2>
				<div class="consultant_block__info">
					Телефон: <a href="<?php echo $contacts['phone_href'] ?>"><?php echo $contacts['phone']; ?></a>
				</div>
				<div class="consultant_block__info">
					Email:
					<a href="mailto:<?php echo $contacts['email']; ?>"><?php echo $contacts['email']; ?></a>
				</div>
				<div class="consultant_block__info">
					<?php echo nl2br($contacts['address']); ?>
				</div>
				<a href="<?php echo $contacts['contacts_url']; ?>" class="consultant_block__link"><?php echo $contacts['contacts_title']; ?></a>
			</div>
		<?php endif; ?>
	</div>
<?php return ob_get_clean();
}
