<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="container">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">Cognicore <span>Technologies</span></a>
		<button class="nav-toggle" aria-label="Menu">&#9776;</button>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => 'nav',
			'menu_class'     => 'nav-menu',
			'fallback_cb'    => false,
		) );
		?>
	</div>
</header>
<main>
