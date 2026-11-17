<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#070b16">
<script>document.documentElement.classList.add('js');</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Skip to content</a>
<header class="site-header" id="top">
	<div class="container bar">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Cognicore Technologies">
			<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
			<svg class="mark" viewBox="0 0 32 32" aria-hidden="true"><defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#22d3ee"/><stop offset=".55" stop-color="#3b82f6"/><stop offset="1" stop-color="#8b5cf6"/></linearGradient></defs><path d="M16 2 28 9v14L16 30 4 23V9z" fill="none" stroke="url(#g)" stroke-width="2.2"/><circle cx="16" cy="16" r="4.2" fill="url(#g)"/></svg>
			<span class="wordmark">Cognicore<small>Technologies</small></span>
			<?php endif; ?>
		</a>
		<button class="nav-toggle" aria-label="Menu" aria-expanded="false"><span></span><span></span></button>
		<nav class="nav" aria-label="Primary">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'nav-menu',
				'fallback_cb'    => false,
			) );
			?>
			<a class="btn btn-sm" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get in touch</a>
		</nav>
	</div>
</header>
<main id="main">
