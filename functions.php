<?php
/**
 * Cognicore theme functions.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'COGNICORE_VERSION', '1.0.0' );
define( 'COGNICORE_COMPANY', 'Cognicore Technologies DWC-LLC' );

/** Company address lines (edit here). */
function cognicore_address_lines() {
	return array(
		'Business Centre, Floor 3',
		'Building A3, Dubai South Business Park',
		'Dubai, United Arab Emirates',
	);
}

/** Licensed business activities (edit here). */
function cognicore_icon( $name ) {
	$icons = array(
		'layers'  => '<path d="M12 2 22 7.5 12 13 2 7.5z"/><path d="m2 12.5 10 5.5 10-5.5"/><path d="m2 17 10 5.5L22 17"/>',
		'code'    => '<path d="m8 7-5 5 5 5M16 7l5 5-5 5M14 4l-4 16"/>',
		'bulb'    => '<path d="M9 18h6M10 21h4M12 3a6 6 0 0 0-3.5 10.9c.6.5 1 1.2 1 2.1h5c0-.9.4-1.6 1-2.1A6 6 0 0 0 12 3z"/>',
		'printer' => '<path d="M7 8V3h10v5M7 17H5a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M7 14h10v7H7z"/>',
		'screen'  => '<rect x="2.5" y="4" width="19" height="12" rx="2"/><path d="M8 20h8M12 16v4"/>',
		'box'     => '<path d="M21 8 12 3 3 8v8l9 5 9-5V8zM3.3 7.5 12 12.5l8.7-5M12 12.5V22"/>',
		'arrow'   => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'pin'     => '<path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/>',
	);
	$p = isset( $icons[ $name ] ) ? $icons[ $name ] : '';
	return '<svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $p . '</svg>';
}

function cognicore_activities() {
	return array(
		array( 'title' => 'Integrated Solutions', 'icon' => 'layers', 'desc' => 'End-to-end projects that combine custom software with custom-built or carefully selected hardware, delivered and supported by one team.' ),
		array( 'title' => 'Software Development', 'icon' => 'code', 'desc' => 'Retail billing, procurement management, service and facility management systems, and e-commerce platforms, built around how your business operates.' ),
		array( 'title' => 'IT & Software Consultancy', 'icon' => 'bulb', 'desc' => 'Expert guidance on technology strategy, system selection and software architecture, so you invest in the right solution from the start.' ),
		array( 'title' => 'Hardware Distribution', 'icon' => 'printer', 'desc' => 'Printers, scanners, POS terminals, barcode scanners and related peripherals for retailers and enterprises.' ),
		array( 'title' => 'Digital Signage', 'icon' => 'screen', 'desc' => 'Smart displays for supermarkets and parking facilities: advertising, live price boards, guidance and information screens.' ),
		array( 'title' => 'General Trading', 'icon' => 'box', 'desc' => 'Sourcing and distribution of a broad portfolio of goods, tailored to client requirements.' ),
	);
}

function cognicore_maps_url() {
	return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( 'Dubai South Business Park Building A3 Dubai' );
}

function cognicore_address_html() {
	return esc_html( implode( ', ', cognicore_address_lines() ) );
}

add_shortcode( 'cognicore_address', function () {
	return '<div class="office-card"><h3>' . esc_html( COGNICORE_COMPANY ) . '</h3><p>' . implode( '<br>', array_map( 'esc_html', cognicore_address_lines() ) ) . '</p><a class="link-arrow" href="' . esc_url( cognicore_maps_url() ) . '" target="_blank" rel="noopener">Open in Maps ' . cognicore_icon( 'arrow' ) . '</a></div>';
} );

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo' );
	register_nav_menus( array( 'primary' => __( 'Primary Menu', 'cognicore' ) ) );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'cognicore-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'cognicore-main', get_template_directory_uri() . '/assets/css/main.css', array( 'cognicore-fonts' ), COGNICORE_VERSION );
	wp_enqueue_style( 'cognicore-style', get_stylesheet_uri(), array( 'cognicore-main' ), COGNICORE_VERSION );
	wp_enqueue_script( 'cognicore-main', get_template_directory_uri() . '/assets/js/main.js', array(), COGNICORE_VERSION, true );
} );

/**
 * On activation: create Home/About/Services/Contact, set static front page, build menu.
 */
add_action( 'after_switch_theme', function () {
	$pages = array(
		'home'     => array( 'Home', "Welcome to Cognicore Technologies." ),
		'about'    => array( 'About', "<p>Cognicore Technologies DWC-LLC combines technology supply, general trading and digital commerce under one roof. Replace this text with your company story.</p><h2>Our mission</h2><p>Describe your mission and values here.</p>" ),
		'services' => array( 'Services', "" ),
		'contact'  => array( 'Contact', "<p>Tell us about your project and we'll get back to you.</p>[cognicore_contact_form]" ),
	);
	$ids = array();
	foreach ( $pages as $slug => $data ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$ids[ $slug ] = $existing->ID;
			continue;
		}
		$ids[ $slug ] = wp_insert_post( array(
			'post_title'   => $data[0],
			'post_name'    => $slug,
			'post_content' => $data[1],
			'post_status'  => 'publish',
			'post_type'    => 'page',
		) );
	}
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $ids['home'] );

	$menu_name = 'Primary Menu';
	if ( ! wp_get_nav_menu_object( $menu_name ) ) {
		$menu_id = wp_create_nav_menu( $menu_name );
		foreach ( array( 'home', 'about', 'services', 'contact' ) as $slug ) {
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'     => $pages[ $slug ][0],
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $ids[ $slug ],
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			) );
		}
		$locations            = get_theme_mod( 'nav_menu_locations', array() );
		$locations['primary'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
} );

/** Contact form shortcode + handler. */
add_shortcode( 'cognicore_contact_form', function () {
	$out = '';
	if ( isset( $_GET['sent'] ) ) {
		$out .= '1' === $_GET['sent']
			? '<div class="notice ok">Thanks! Your message has been sent.</div>'
			: '<div class="notice err">Sorry, something went wrong. Please fill all fields and try again.</div>';
	}
	ob_start();
	?>
	<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="cognicore_contact">
		<?php wp_nonce_field( 'cognicore_contact', 'cognicore_nonce' ); ?>
		<div class="form-row"><label for="cc-name">Name</label><input id="cc-name" name="name" required></div>
		<div class="form-row"><label for="cc-email">Email</label><input id="cc-email" type="email" name="email" required></div>
		<div class="form-row"><label for="cc-msg">Message</label><textarea id="cc-msg" name="message" rows="6" required></textarea></div>
		<button class="btn" type="submit">Send message</button>
	</form>
	<?php
	return $out . ob_get_clean();
} );

function cognicore_handle_contact() {
	$back = wp_get_referer() ? remove_query_arg( 'sent', wp_get_referer() ) : home_url( '/' );
	if ( ! isset( $_POST['cognicore_nonce'] ) || ! wp_verify_nonce( $_POST['cognicore_nonce'], 'cognicore_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'sent', '0', $back ) );
		exit;
	}
	$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );
	$ok      = false;
	if ( $name && is_email( $email ) && $message ) {
		$ok = wp_mail(
			get_option( 'admin_email' ),
			'New contact message from ' . $name,
			$message . "\n\nFrom: $name <$email>",
			array( 'Reply-To: ' . $name . ' <' . $email . '>' )
		);
	}
	wp_safe_redirect( add_query_arg( 'sent', $ok ? '1' : '0', $back ) );
	exit;
}
add_action( 'admin_post_nopriv_cognicore_contact', 'cognicore_handle_contact' );
add_action( 'admin_post_cognicore_contact', 'cognicore_handle_contact' );
