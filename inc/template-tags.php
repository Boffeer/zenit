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

function zenit_share_buttons($id)
{
	$URL = get_the_permalink();
	$TITLE = get_the_title();
	$IMG_PATH = esc_url((wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail')[0]));
	$DESC = the_truncated_post(100);
	$shares = array(
		'vk' => "Share.vkontakte('$URL','$TITLE','$IMG_PATH','$DESC')",
		// odnoklassniki: function (purl, text) {
		// 	  facebook: function (purl, ptitle, pimg, text) {
		// 			  twitter: function (purl, ptitle) {
	);
	// var_dump($shares);

	ob_start();
?>
	<div class="detail-news-page__footer-social fl-align">
		<p class="detail-news-page__footer-social-text">Поделиться:</p>
		<a href="" class="detail-news-page__footer-social-link">
			<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M11 17.938C13.0173 17.6813 14.8611 16.6661 16.1568 15.0988C17.4525 13.5314 18.1027 11.5295 17.9754 9.49997C17.848 7.47041 16.9527 5.56549 15.4713 4.17238C13.9898 2.77927 12.0336 2.00252 10 2C7.96396 1.99848 6.00395 2.77334 4.51934 4.16668C3.03473 5.56002 2.13724 7.46699 2.00974 9.49904C1.88225 11.5311 2.53434 13.5353 3.83314 15.1033C5.13195 16.6712 6.97974 17.685 9 17.938V12H7V10H9V8.346C9 7.009 9.14 6.524 9.4 6.035C9.65611 5.55119 10.052 5.15569 10.536 4.9C10.918 4.695 11.393 4.572 12.223 4.519C12.552 4.498 12.978 4.524 13.501 4.599V6.499H13C12.083 6.499 11.704 6.542 11.478 6.663C11.3431 6.73236 11.2334 6.84215 11.164 6.977C11.044 7.203 11 7.427 11 8.345V10H13.5L13 12H11V17.938ZM10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20Z" fill="black" />
			</svg>
		</a>
		<a href="" class="detail-news-page__footer-social-link">
			<svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M19.5691 2.23674L16.6644 15.9352C16.4451 16.9018 15.8738 17.1424 15.0618 16.6873L10.6357 13.4258L8.50033 15.4801C8.26383 15.7166 8.06651 15.9139 7.6107 15.9139L7.92901 11.4066L16.1316 3.99468C16.4884 3.67705 16.0539 3.50036 15.5775 3.81868L5.43683 10.2042L1.0712 8.83743C0.121765 8.54111 0.104577 7.88799 1.2692 7.43218L18.3446 0.853489C19.1353 0.557177 19.8269 1.02949 19.5691 2.23743V2.23674Z" fill="black" />
			</svg>
		</a>
		<a href="" class="detail-news-page__footer-social-link">
			<svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M19.0002 9.38596C13.6799 9.38596 9.38616 13.6797 9.38616 19C9.38616 24.3203 13.6799 28.6141 19.0002 28.6141C24.3205 28.6141 28.6143 24.3203 28.6143 19C28.6143 13.6797 24.3205 9.38596 19.0002 9.38596ZM19.0002 25.2485C15.5596 25.2485 12.7518 22.4407 12.7518 19C12.7518 15.5594 15.5596 12.7516 19.0002 12.7516C22.4409 12.7516 25.2487 15.5594 25.2487 19C25.2487 22.4407 22.4409 25.2485 19.0002 25.2485ZM29.008 6.75159C27.7659 6.75159 26.7627 7.75471 26.7627 8.9969C26.7627 10.2391 27.7659 11.2422 29.008 11.2422C30.2502 11.2422 31.2534 10.2438 31.2534 8.9969C31.2537 8.70194 31.1959 8.4098 31.0832 8.13722C30.9705 7.86464 30.8051 7.61697 30.5965 7.4084C30.388 7.19983 30.1403 7.03446 29.8677 6.92175C29.5951 6.80904 29.303 6.75122 29.008 6.75159ZM37.7409 19C37.7409 16.4125 37.7643 13.8485 37.619 11.2657C37.4737 8.26565 36.7893 5.60315 34.5955 3.4094C32.3971 1.21096 29.7393 0.531277 26.7393 0.385964C24.1518 0.240652 21.5877 0.26409 19.0049 0.26409C16.4174 0.26409 13.8534 0.240652 11.2705 0.385964C8.27054 0.531277 5.60804 1.21565 3.41429 3.4094C1.21585 5.60784 0.53616 8.26565 0.390847 11.2657C0.245535 13.8532 0.268972 16.4172 0.268972 19C0.268972 21.5828 0.245535 24.1516 0.390847 26.7344C0.53616 29.7344 1.22054 32.3969 3.41429 34.5906C5.61272 36.7891 8.27054 37.4688 11.2705 37.6141C13.858 37.7594 16.4221 37.736 19.0049 37.736C21.5924 37.736 24.1565 37.7594 26.7393 37.6141C29.7393 37.4688 32.4018 36.7844 34.5955 34.5906C36.794 32.3922 37.4737 29.7344 37.619 26.7344C37.769 24.1516 37.7409 21.5875 37.7409 19ZM33.6159 30.0531C33.2737 30.9063 32.8612 31.5438 32.2002 32.2C31.5393 32.861 30.9065 33.2735 30.0534 33.6157C27.5877 34.5953 21.733 34.375 19.0002 34.375C16.2674 34.375 10.408 34.5953 7.94241 33.6203C7.08929 33.2781 6.45179 32.8657 5.79554 32.2047C5.1346 31.5438 4.7221 30.911 4.37991 30.0578C3.40491 27.5875 3.62522 21.7328 3.62522 19C3.62522 16.2672 3.40491 10.4078 4.37991 7.94221C4.7221 7.08909 5.1346 6.45159 5.79554 5.79534C6.45647 5.13909 7.08929 4.7219 7.94241 4.37971C10.408 3.40471 16.2674 3.62503 19.0002 3.62503C21.733 3.62503 27.5924 3.40471 30.058 4.37971C30.9112 4.7219 31.5487 5.1344 32.2049 5.79534C32.8659 6.45628 33.2784 7.08909 33.6205 7.94221C34.5955 10.4078 34.3752 16.2672 34.3752 19C34.3752 21.7328 34.5955 27.5875 33.6159 30.0531Z" fill="black" />
			</svg>
		</a>
		<a href="" class="detail-news-page__footer-social-link">
			<svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M21.5001 1.58929C21.5001 1.50104 21.4767 1.41436 21.4323 1.33806C21.388 1.26177 21.3242 1.19858 21.2475 1.1549C21.1708 1.11122 21.084 1.08862 20.9957 1.08939C20.9075 1.09016 20.821 1.11428 20.7451 1.15929C20.0413 1.57838 19.2769 1.88602 18.4791 2.07129C17.6071 1.23881 16.4466 0.776461 15.2411 0.781287C14.5863 0.782217 13.9389 0.919052 13.3397 1.18313C12.7405 1.44721 12.2027 1.83279 11.7603 2.31546C11.3178 2.79813 10.9804 3.36739 10.7693 3.98721C10.5583 4.60702 10.4782 5.26391 10.5341 5.91629C7.5112 5.59503 4.7376 4.09268 2.81707 1.73629C2.76581 1.67369 2.70013 1.62446 2.62565 1.59283C2.55118 1.56121 2.47014 1.54813 2.3895 1.55472C2.30886 1.56131 2.23102 1.58737 2.16267 1.63066C2.09432 1.67396 2.03749 1.7332 1.99707 1.80329C1.58219 2.52678 1.36396 3.34628 1.36407 4.18029C1.36285 5.09562 1.62758 5.9916 2.12607 6.75929L2.06607 6.72629C1.98773 6.68783 1.90073 6.67037 1.81361 6.67563C1.72649 6.68089 1.64223 6.70868 1.56907 6.75629C1.49285 6.80585 1.4303 6.87375 1.38714 6.95377C1.34398 7.03379 1.32161 7.12337 1.32207 7.21429C1.31807 7.33229 1.32507 7.45129 1.34407 7.56729C1.39134 8.22751 1.57776 8.87026 1.89109 9.45332C2.20442 10.0364 2.63756 10.5465 3.16207 10.9503C3.09815 10.9691 3.03863 11.0005 2.98701 11.0427C2.9354 11.0848 2.89273 11.1369 2.86152 11.1958C2.83031 11.2546 2.81119 11.3192 2.80527 11.3855C2.79935 11.4519 2.80677 11.5188 2.82707 11.5823C3.05808 12.3026 3.45938 12.9565 3.99695 13.4887C4.53451 14.0209 5.19249 14.4156 5.91507 14.6393C4.43956 15.4654 2.74019 15.8025 1.06107 15.6023C0.948555 15.5882 0.834594 15.6128 0.737892 15.672C0.64119 15.7313 0.56749 15.8216 0.528888 15.9282C0.490285 16.0348 0.489072 16.1514 0.525447 16.2588C0.561822 16.3662 0.633626 16.4581 0.729075 16.5193C2.73852 17.8132 5.0781 18.5009 7.46807 18.5003C10.1792 18.5302 12.8243 17.6634 14.992 16.0347C17.1596 14.406 18.7283 12.1067 19.4541 9.49429C19.7931 8.35729 19.9661 7.17629 19.9681 5.98929C19.9681 5.86929 19.9681 5.74429 19.9651 5.61729C20.4852 5.08846 20.8901 4.45762 21.1543 3.76453C21.4185 3.07144 21.5362 2.33114 21.5001 1.59029V1.58929ZM19.0761 5.12229C18.9939 5.21941 18.9521 5.34428 18.9591 5.47129C19.0137 6.73542 18.8569 7.99981 18.4951 9.21229C17.8497 11.6285 16.4124 13.7584 14.4132 15.261C12.414 16.7636 9.96847 17.5521 7.46807 17.5003C5.9421 17.5003 4.43151 17.1954 3.02507 16.6033C4.67799 16.4199 6.24601 15.7754 7.55007 14.7433C7.63121 14.6795 7.69062 14.5922 7.72015 14.4933C7.74969 14.3944 7.7479 14.2888 7.71503 14.191C7.68217 14.0931 7.61984 14.0079 7.53659 13.9469C7.45334 13.8859 7.35326 13.8521 7.25007 13.8503C6.61003 13.8399 5.98357 13.664 5.4316 13.3399C4.87962 13.0157 4.42092 12.5542 4.10007 12.0003C4.52507 12.0013 4.94707 11.9433 5.35407 11.8263C5.46134 11.7949 5.55498 11.7284 5.62004 11.6375C5.6851 11.5466 5.71783 11.4365 5.71299 11.3248C5.70816 11.2132 5.66604 11.1063 5.59337 11.0214C5.5207 10.9365 5.42166 10.8783 5.31207 10.8563C4.59626 10.713 3.9387 10.3616 3.42189 9.84603C2.90508 9.33046 2.55204 8.67375 2.40707 7.95829C2.83176 8.096 3.27383 8.17277 3.72007 8.18629C3.83002 8.19443 3.93935 8.16391 4.02919 8.1C4.11902 8.0361 4.18371 7.94282 4.21207 7.83629C4.24474 7.73287 4.24289 7.62164 4.20682 7.51937C4.17074 7.41709 4.10239 7.32932 4.01207 7.26929C3.50332 6.93064 3.08648 6.47112 2.79887 5.93186C2.51127 5.3926 2.36188 4.79044 2.36407 4.17929C2.36407 3.76629 2.43107 3.35629 2.56407 2.96629C4.78111 5.36031 7.84546 6.79381 11.1041 6.96129C11.1819 6.96961 11.2606 6.95748 11.3323 6.92609C11.4041 6.89469 11.4664 6.84513 11.5131 6.78229C11.5627 6.72286 11.5978 6.65272 11.6157 6.57741C11.6335 6.5021 11.6337 6.42366 11.6161 6.34829C11.5501 6.07247 11.5165 5.78989 11.5161 5.50629C11.5171 4.51876 11.9098 3.57196 12.6079 2.87348C13.306 2.17501 14.2525 1.78188 15.2401 1.78029C15.7487 1.77884 16.2522 1.88286 16.7186 2.08579C17.1851 2.28872 17.6044 2.58614 17.9501 2.95929C18.0081 3.02122 18.081 3.06731 18.1619 3.09321C18.2427 3.11911 18.3288 3.12395 18.4121 3.10729C19.1217 2.96757 19.8117 2.74226 20.4671 2.43629C20.2967 3.4556 19.8097 4.39537 19.0751 5.12229H19.0761Z" fill="black" />
			</svg>
		</a>
		<a href="" class="detail-news-page__footer-social-link">
			<svg width="22" height="37" viewBox="0 0 22 37" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M10.9995 18.7271C8.4652 18.7271 6.3016 17.8118 4.50871 15.981C2.71582 14.1503 1.81937 11.9479 1.81937 9.37388C1.81937 6.78609 2.71582 4.57682 4.50871 2.74609C6.3016 0.915365 8.4652 0 10.9995 0C13.5338 0 15.6974 0.915365 17.4903 2.74609C19.2832 4.57682 20.1797 6.78609 20.1797 9.37388C20.1797 11.9479 19.2832 14.1503 17.4903 15.981C15.6974 17.8118 13.5338 18.7271 10.9995 18.7271ZM10.9995 4.74888C9.75932 4.74888 8.69774 5.19968 7.81478 6.10128C6.93181 7.00288 6.49033 8.09375 6.49033 9.37388C6.49033 10.6403 6.93181 11.7242 7.81478 12.6258C8.69774 13.5274 9.75932 13.9782 10.9995 13.9782C12.2397 13.9782 13.3013 13.5274 14.1843 12.6258C15.0672 11.7242 15.5087 10.6403 15.5087 9.37388C15.5087 8.09375 15.0672 7.00288 14.1843 6.10128C13.3013 5.19968 12.2397 4.74888 10.9995 4.74888ZM21.5749 19.8627C21.7501 20.2344 21.8512 20.5751 21.8782 20.8848C21.9052 21.1945 21.8748 21.4732 21.7872 21.721C21.6996 21.9688 21.521 22.2337 21.2514 22.5159C20.9817 22.7981 20.6953 23.0527 20.392 23.2799C20.0887 23.507 19.6741 23.7926 19.1484 24.1367C17.5982 25.1416 15.475 25.7885 12.7789 26.0776L14.255 27.5642L19.6539 33.077C20.0583 33.5037 20.2605 34.013 20.2605 34.6049C20.2605 35.1968 20.0583 35.6992 19.6539 36.1122L19.4113 36.3806C18.9934 36.7935 18.4946 37 17.915 37C17.3353 37 16.8365 36.7935 16.4186 36.3806C15.5154 35.4446 13.7158 33.6001 11.0197 30.8471L5.62084 36.3806C5.20295 36.7935 4.70418 37 4.12452 37C3.54486 37 3.05283 36.7935 2.64842 36.3806L2.40577 36.1122C1.98788 35.6992 1.77893 35.1968 1.77893 34.6049C1.77893 34.013 1.98788 33.5037 2.40577 33.077L7.80467 27.5642L9.26055 26.0776C6.52403 25.7885 4.38739 25.1416 2.85062 24.1367C2.32489 23.7926 1.91037 23.507 1.60706 23.2799C1.30375 23.0527 1.01729 22.7981 0.747682 22.5159C0.478074 22.2337 0.299459 21.9688 0.211836 21.721C0.124214 21.4732 0.0938829 21.1945 0.120844 20.8848C0.147804 20.5751 0.248907 20.2344 0.424152 19.8627C0.558956 19.5874 0.747682 19.3465 0.990329 19.1401C1.23298 18.9336 1.51606 18.7822 1.83959 18.6858C2.16312 18.5895 2.54057 18.6032 2.97195 18.7271C3.40332 18.851 3.84143 19.0919 4.28628 19.4498C4.35369 19.5048 4.45479 19.5805 4.58959 19.6769C4.7244 19.7733 5.01422 19.9419 5.45908 20.1828C5.90393 20.4236 6.369 20.6336 6.8543 20.8125C7.33959 20.9914 7.95969 21.1566 8.71459 21.308C9.46949 21.4594 10.2311 21.5352 10.9995 21.5352C12.2262 21.5352 13.399 21.3597 14.5179 21.0086C15.6368 20.6576 16.4456 20.3101 16.9444 19.966L17.7128 19.4498C18.1576 19.0919 18.5957 18.851 19.0271 18.7271C19.4585 18.6032 19.8359 18.5895 20.1594 18.6858C20.483 18.7822 20.7661 18.9336 21.0087 19.1401C21.2514 19.3465 21.4401 19.5874 21.5749 19.8627Z" fill="black" />
			</svg>
		</a>
		<a onclick="<?php echo $shares['vk']; ?>" class="detail-news-page__footer-social-link">
			<svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M17.8021 8.2982C17.8021 8.2982 19.4191 9.8952 19.8191 10.6342C19.8269 10.6449 19.8329 10.6567 19.8371 10.6692C20.0001 10.9422 20.0401 11.1562 19.9601 11.3142C19.8251 11.5752 19.3681 11.7062 19.2131 11.7172H16.3551C16.1561 11.7172 15.7421 11.6652 15.2381 11.3172C14.8531 11.0482 14.4701 10.6052 14.0991 10.1722C13.5451 9.5292 13.0661 8.9712 12.5811 8.9712C12.5198 8.97107 12.459 8.98121 12.4011 9.0012C12.0341 9.1172 11.5681 9.6402 11.5681 11.0332C11.5681 11.4692 11.2241 11.7172 10.9831 11.7172H9.67409C9.22809 11.7172 6.90609 11.5612 4.84709 9.3902C2.32409 6.7322 0.05809 1.4002 0.03609 1.3532C-0.10491 1.0082 0.19109 0.820203 0.51109 0.820203H3.39709C3.78409 0.820203 3.91009 1.0542 3.99809 1.2642C4.10009 1.5052 4.47809 2.4692 5.09809 3.5522C6.10209 5.3142 6.71909 6.0312 7.21209 6.0312C7.30471 6.03147 7.39577 6.00733 7.47609 5.9612C8.12009 5.6072 8.00009 3.3072 7.97009 2.8332C7.97009 2.7412 7.96909 1.8062 7.63909 1.3542C7.40309 1.0302 7.00109 0.904203 6.75809 0.858203C6.82309 0.764203 6.96109 0.620203 7.13809 0.535203C7.57909 0.315203 8.37609 0.283203 9.16709 0.283203H9.60609C10.4641 0.295203 10.6861 0.350203 10.9981 0.429203C11.6261 0.579203 11.6381 0.986203 11.5831 2.3722C11.5671 2.7682 11.5501 3.2142 11.5501 3.7392C11.5501 3.8512 11.5451 3.9762 11.5451 4.1032C11.5261 4.8142 11.5011 5.6152 12.0031 5.9442C12.0682 5.98476 12.1434 6.00624 12.2201 6.0062C12.3941 6.0062 12.9151 6.0062 14.3281 3.5812C14.9481 2.5102 15.4281 1.2472 15.4611 1.1522C15.4891 1.0992 15.5731 0.950203 15.6751 0.890203C15.7476 0.851598 15.8289 0.832314 15.9111 0.834203H19.3061C19.6761 0.834203 19.9271 0.890203 19.9761 1.0302C20.0581 1.2572 19.9601 1.9502 18.4101 4.0462C18.1491 4.3952 17.9201 4.6972 17.7191 4.9612C16.3141 6.8052 16.3141 6.8982 17.8021 8.2982V8.2982Z" fill="black" />
			</svg>
		</a>
	</div>
<?php
	return ob_get_clean();
}
