<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zenit
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php
	$page_id = get_the_ID();
	$title = carbon_get_post_meta($page_id, 'page_title');
	$desc = carbon_get_post_meta($page_id, 'page_description');
	$og_image = carbon_get_post_meta($page_id, 'og_image');
	?>
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo get_site_url(); ?>" />
	<?php if ($title) : ?>
		<title><?php echo $title; ?></title>
		<meta property="og:title" content="<?php echo $title; ?>" />
	<?php endif; ?>
	<?php if ($desc) : ?>
		<meta name="description" content="<?php echo $desc; ?>">
		<meta property="og:description" content="<?php echo $desc; ?>" />
	<?php endif; ?>
	<meta property="og:image" content="<?php echo $og_image; ?>" />

	<?php wp_head(); ?>
</head>

<?php
$contacts = zenit_get_contacts();
?>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div class="wrapper">
		<header>
			<div class="container fl-align">
				<div class="header-picture">
					<img class="header-picture__logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="logo" />
				</div>
				<div class="header-all">
					<div class="header-all__top fl-align">
						<div class="header-all__top-box fl-align">
							<a href="<?php echo $contacts['phone_href'] ?>" class="header-all__top-phone fl-align">
								<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.72514 4.03387L8.5593 3.87615C8.14866 3.45031 8.21973 3.25316 8.62248 2.85098L10.7704 0.682355C11.4101 0.0357097 11.5286 -0.271841 12.1366 0.303831L12.3025 0.461549L8.72514 4.03387ZM9.14368 4.38874L12.6183 0.918932C13.1711 1.66021 14.4662 3.65535 13.8266 5.13001C13.2501 6.44696 12.9658 6.51005 12.2472 7.49579C10.7862 9.15972 8.94625 10.9419 7.50901 12.2825C6.51399 13.0002 6.47451 13.3314 5.13992 13.8597C3.71847 14.4196 1.66527 13.1579 0.891364 12.6295L4.36602 9.15972L5.29786 10.4372C5.56636 10.8 6.2455 10.3899 6.71931 9.91676C7.5406 9.08874 9.23054 7.40904 9.87809 6.7072C10.344 6.24193 10.7626 5.56374 10.3993 5.28773L9.14368 4.38874ZM0.441238 12.3141L0.275402 12.1485C-0.261591 11.5649 0.0463901 11.4387 0.686043 10.8079L2.84981 8.6629C3.25255 8.27649 3.44208 8.18975 3.85272 8.57616L4.01066 8.74176L0.441238 12.3141Z" fill="#222222" />
								</svg>
								<?php echo $contacts['phone']; ?>
							</a>
							<p class="header-all__top-text">(???????????????????? ???? ????????????)</p>
							<a href="mailto:<?php echo $contacts['email']; ?>" class="header-all__top-mail fl-align">
								<svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M1 3.33333V12.6667C1 13.2855 1.27092 13.879 1.75315 14.3166C2.23539 14.7542 2.88944 15 3.57143 15H16.4286C17.1106 15 17.7646 14.7542 18.2468 14.3166C18.7291 13.879 19 13.2855 19 12.6667V3.33333C19 2.71449 18.7291 2.121 18.2468 1.68342C17.7646 1.24583 17.1106 1 16.4286 1H3.57143C2.88944 1 2.23539 1.24583 1.75315 1.68342C1.27092 2.121 1 2.71449 1 3.33333V3.33333Z" stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
									<path d="M3.57129 4.5L9.99986 8L16.4284 4.5" stroke="#222222" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
								<?php echo $contacts['email']; ?>
							</a>
							<a href="" class="header-all__top-adress fl-align">
								<svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M4.91307 2.38574C4.44045 2.38574 3.97844 2.52589 3.58546 2.78847C3.19249 3.05104 2.8862 3.42425 2.70534 3.8609C2.52447 4.29755 2.47715 4.77803 2.56935 5.24157C2.66156 5.70511 2.88915 6.13091 3.22335 6.4651C3.55754 6.7993 3.98333 7.02689 4.44688 7.11909C4.91042 7.2113 5.3909 7.16397 5.82754 6.98311C6.26419 6.80224 6.6374 6.49596 6.89998 6.10298C7.16255 5.71001 7.3027 5.248 7.3027 4.77538C7.3027 4.14161 7.05094 3.53379 6.6028 3.08565C6.15465 2.63751 5.54684 2.38574 4.91307 2.38574ZM4.91307 6.33093C4.60541 6.33093 4.30466 6.2397 4.04885 6.06877C3.79304 5.89785 3.59366 5.6549 3.47593 5.37066C3.35819 5.08642 3.32738 4.77365 3.38741 4.4719C3.44743 4.17015 3.59558 3.89298 3.81313 3.67543C4.03068 3.45788 4.30785 3.30973 4.6096 3.24971C4.91135 3.18969 5.22412 3.22049 5.50836 3.33823C5.7926 3.45597 6.03554 3.65535 6.20647 3.91116C6.37739 4.16696 6.46863 4.46772 6.46863 4.77538C6.46752 5.18721 6.30315 5.5818 6.01154 5.87262C5.71994 6.16345 5.32491 6.32676 4.91307 6.32676V6.33093Z" fill="#222222" />
									<path d="M9.82133 5.20868C9.53835 5.20082 9.25776 5.15452 8.98725 5.07106V5.30877C8.98725 7.00195 7.97802 8.50746 7.23986 9.60845L7.08972 9.82948C6.37242 10.9054 5.42157 12.1107 4.90861 12.707C4.4165 12.1107 3.4448 10.9054 2.7275 9.82948L2.5857 9.59176C1.84755 8.49078 0.834141 6.98527 0.834141 5.29209C0.83667 4.59084 1.02014 3.90212 1.36681 3.29255C1.71348 2.68298 2.21161 2.1732 2.813 1.81253C3.4144 1.45186 4.0987 1.25252 4.7997 1.23378C5.5007 1.21503 6.19467 1.37754 6.81448 1.70556C6.84767 1.41881 6.92066 1.13808 7.03134 0.87148C6.28243 0.509777 5.45378 0.344637 4.62343 0.391613C3.79308 0.438588 2.98835 0.696132 2.28501 1.13999C1.58168 1.58385 1.00288 2.19942 0.603142 2.92874C0.203399 3.65805 -0.00414253 4.4771 6.26539e-05 5.30877C6.26539e-05 7.25635 1.0927 8.88697 1.89342 10.0755L2.03938 10.2924C2.83604 11.447 3.69068 12.5605 4.6 13.6287L4.91695 13.9999L5.2339 13.6287C6.14311 12.5605 6.99774 11.4469 7.79452 10.2924L7.94048 10.0714C8.73703 8.8828 9.82967 7.25635 9.82967 5.30877C9.8255 5.27541 9.82133 5.24205 9.82133 5.20868Z" fill="#222222" />
									<path d="M9.91723 4.17039C11.0688 4.17039 12.0024 3.23682 12.0024 2.08519C12.0024 0.933573 11.0688 0 9.91723 0C8.7656 0 7.83203 0.933573 7.83203 2.08519C7.83203 3.23682 8.7656 4.17039 9.91723 4.17039Z" fill="#222222" />
								</svg>
								<?php echo $contacts['address'] ?>
							</a>
							<a href="https://www.instagram.com/<?php echo $contacts['instagram']; ?>" rel="nofollow" target="_blank" class="header-all__top-social fl-align">
								Instagram: <?php echo $contacts['instagram']; ?></a>
						</div>
						<button data-modal-open="consultation" class="header-all__top-btn">???????????????? ????????????</button>
					</div>
					<div class="header-all__bottom fl-align">
						<ul class="header-all__bottom-menu fl-align">
							<?php
							$header_menu_id = 4;
							$header_menu_items =  wp_get_nav_menu_items($header_menu_id, [
								'output_key'  => 'menu_order',
								'level' => 3,
								'order'                  => 'ASC',
								'orderby'                => 'menu_order',
								'output'                 => ARRAY_A,
							]);
							echo '<pre>';
							// var_dump($header_menu_items);
							echo '</pre>';

							$menu_levels = array();
							foreach ($header_menu_items as $menu) {
								if ($menu->menu_item_parent == 0) {
									$menu_levels[] = array(
										'item' => $menu,
										'name' => $menu->title,
										'id' => $menu->ID,
										// 'id' => $menu->object_id,
									);
								}
							}

							foreach ($menu_levels as $key_1 => $top_menu) {
								foreach ($header_menu_items as $key_2 => $m2) {
									if ($top_menu['id'] == $m2->menu_item_parent) {
										$menu_levels[$key_1]['children'][$key_2][] = array(
											'item' => $m2,
											'name' => $m2->title,
											// 'id' => $m2->object_id,
											'id' => $m2->object_id,
											'parent' => $m2->menu_item_parent,
										);
									}
								}
							}

							echo '<pre>';
							// var_dump($menu_levels);
							// var_dump($header_menu_items);
							echo '</pre>';
							/*
							$header_menu = array();

							$visual_menu = array();
							foreach ($header_menu_items as $key => $item) {
								if ($item->menu_item_parent == 0) {
									$header_menu[] = array(
										'id' => $item->ID,
										'parent' => $item,
									);
									unset($header_menu_items[$key]);
									$visual_menu[] = array(
										'title' => $item->title . ' ' . $item->ID,
									);
								}
							}

							foreach ($header_menu as $key_1 => $menu) {
								foreach ($header_menu_items as $key_2 => $m2) {
									if ($menu['parent']->ID == $m2->menu_item_parent) {
										// echo $menu['parent']->title . '-' . $menu['parent']->ID . '------' . $m2->title . '-' . $m2->menu_item_parent . '<br>';
										$header_menu[$key_1]['children'][] = $m2;
										$visual_menu[$key_1]['children'][] = $m2->title . ' ' . $m2->ID . '<' . $m2->menu_item_parent;
									}
								}
								// echo '<br>';
							}

							foreach ($header_menu as $key_1 => $menu) {
								if (!isset($menu['children'])) continue;
								foreach ($menu['children'] as $key_2 => $m2) {
									// echo '<pre>';
									// var_dump($m2);
									// echo '</pre>';
									// echo $m2->ID . '<br>';


									foreach ($header_menu_items as $key_3 => $m3) {
										// echo $menu['children'][$key_2]->ID . '---' . $m3->menu_item_parent . '<br>';
										// if ($menu['parent'])
										// echo '<pre>';
										// var_dump($m2);
										// echo '</pre>';
									}
									echo '--<br>';
								}
								echo '<br>';
							}
							// echo '<pre>';
							// var_dump($visual_menu);
							// echo '</pre>';
							*/
							?>
							<?php foreach ($menu_levels as $menu) : ?>
								<?php if (!isset($menu['children'])) : ?>
									<li class="header-all__bottom__list">
										<a href="<?php echo $menu['item']->url; ?>" class="header-all__bottom__list-link"><?php echo $menu['item']->title; ?></a>
									</li>
								<?php else : ?>
									<li class="header-all__bottom__list dropdown fl-align">
										<a href="<?php echo $menu['item']->url; ?>" class="header-all__bottom__list-link"><?php echo $menu['item']->title; ?></a>
										<ul class="header-all__bottom__list-children">
											<?php echo '<pre>';
											// var_dump($menu['children']);
											echo '</pre>'; ?>
											<?php foreach ($menu['children'] as $children) : ?>
												<?php foreach ($children as $child) : ?>
													<p><?php echo '<pre>';
															// var_dump($child);
															echo '</pre>'; ?></p>
													<li class="header-all__bottom__list-children-li">
														<a href="<?php echo $child['item']->url; ?>"><?php echo $child['item']->title; ?></a>
													</li>
												<?php endforeach; ?>
											<?php endforeach; ?>
											<!-- <li class="header-all__bottom__list-children-li dropdown">
												<a href="">?????? ???????????????? ??????????
													<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M5.5 9L0 0L11 9.08524e-07L5.5 9Z" fill="#222222" />
													</svg>
												</a>
												<ul class="header-all__bottom__list-children-submenu">
													<li class="header-all__bottom__list-children-li-submenu">
														<a href="">?????????????? ????????????</a>
													</li>
													<li class="header-all__bottom__list-children-li-submenu">
														<a href="">?????????????????????? ????????????????????????</a>
													</li>
													<li class="header-all__bottom__list-children-li-submenu">
														<a href="">?????????????????????? ??????????????????</a>
													</li>
												</ul>
											</li> -->
										</ul>
										<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M5.5 9L0 0L11 9.08524e-07L5.5 9Z" fill="#222222" />
										</svg>
									</li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
						<!-- <ul class="header-all__bottom-menu fl-align">
							<li class="header-all__bottom__list">
								<a href="" class="header-all__bottom__list-link">??????????????</a>
							</li>
							<li class="header-all__bottom__list dropdown fl-align">
								<a href="" class="header-all__bottom__list-link">??????????????</a>
								<ul class="header-all__bottom__list-children">
									<li class="header-all__bottom__list-children-li">
										<a href="">???????????????? ?? ????????????</a>
									</li>
									<li class="header-all__bottom__list-children-li dropdown">
										<a href="">?????? ???????????????? ??????????
											<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M5.5 9L0 0L11 9.08524e-07L5.5 9Z" fill="#222222" />
											</svg>
										</a>
										<ul class="header-all__bottom__list-children-submenu">
											<li class="header-all__bottom__list-children-li-submenu">
												<a href="">?????????????? ????????????</a>
											</li>
											<li class="header-all__bottom__list-children-li-submenu">
												<a href="">?????????????????????? ????????????????????????</a>
											</li>
											<li class="header-all__bottom__list-children-li-submenu">
												<a href="">?????????????????????? ??????????????????</a>
											</li>
										</ul>
									</li>
									<li class="header-all__bottom__list-children-li">
										<a href="">?????????????? ????????????</a>
									</li>
									<li class="header-all__bottom__list-children-li">
										<a href="">?????????????????????? ????????????????????????</a>
									</li>
									<li class="header-all__bottom__list-children-li">
										<a href="">?????????????????????? ??????????????????</a>
									</li>
								</ul>
								<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.5 9L0 0L11 9.08524e-07L5.5 9Z" fill="#222222" />
								</svg>
							</li>
							<li class="header-all__bottom__list dropdown fl-align">
								<a href="" class="header-all__bottom__list-link">?? ????????????????</a>
								<ul class="header-all__bottom__list-children">
									<li class="header-all__bottom__list-children-li">
										<a href="">????????????????</a>
									</li>
									<li class="header-all__bottom__list-children-li">
										<a href="">??????????????????????</a>
									</li>
									<li class="header-all__bottom__list-children-li">
										<a href="">???????????????? </a>
									</li>
									<li class="header-all__bottom__list-children-li">
										<a href="">???????????? </a>
									</li>
									<li class="header-all__bottom__list-children-li">
										<a href="">?????????????? </a>
									</li>
								</ul>
								<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.5 9L0 0L11 9.08524e-07L5.5 9Z" fill="#222222" />
								</svg>
							</li>
							<li class="header-all__bottom__list dropdown fl-align">
								<a href="" class="header-all__bottom__list-link">??????????????????????</a>
								<ul class="header-all__bottom__list-children">
									<li class="header-all__bottom__list-children-li">
										<a href="">???????????????? ?? ???????????? </a>
									</li>
									<li class="header-all__bottom__list-children-li">
										<a href="">?????? ???????????????? ?????????? </a>
									</li>
									<li class="header-all__bottom__list-children-li">
										<a href="">?????????????????????? ???????????????????????? </a>
									</li>
									<li class="header-all__bottom__list-children-li">
										<a href="">?????????????????????? ?????????????????? </a>
									</li>
								</ul>
								<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.5 9L0 0L11 9.08524e-07L5.5 9Z" fill="#222222" />
								</svg>
							</li>
							<li class="header-all__bottom__list">
								<a href="" class="header-all__bottom__list-link">??????????????</a>
							</li>
							<li class="header-all__bottom__list">
								<a href="" class="header-all__bottom__list-link">????????????????</a>
							</li>
						</ul> -->
						<?php echo get_search_form(); ?>
					</div>
				</div>
				<div class="header_mobile" data-search data-search-mobile>
					<div class="header_mobile__gamburger burger">
						<span></span><span></span><span></span><span></span>
					</div>
					<div class="header_mobile__search">
						<svg>
							<use href="<?php echo get_stylesheet_directory_uri(); ?>/img/sprite.svg#search"></use>
						</svg>
						<input type="search" class="search-input" placeholder="??????????" />
						<span class="search-esc">
							<svg>
								<use href="<?php echo get_stylesheet_directory_uri(); ?>/img/sprite.svg#esc"></use>
							</svg>
						</span>
					</div>
				</div>
			</div>
		</header>
