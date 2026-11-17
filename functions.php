<?php
/**
 * Cognicore theme functions.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'COGNICORE_VERSION', '1.0.0' );
define( 'COGNICORE_COMPANY', 'Cognicore Technologies DWC-LLC' );
require_once get_template_directory() . '/inc/contact.php';
require_once get_template_directory() . '/inc/colors.php';
require_once get_template_directory() . '/inc/smtp.php';
require_once get_template_directory() . '/inc/social.php';

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
		'phone'    => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
		'whatsapp' => '<path d="M21 11.5a8.4 8.4 0 0 1-12.4 7.4L3 21l2-5.4A8.4 8.4 0 1 1 21 11.5z"/><path d="M9.2 8.6c0 3.3 2.9 6.2 6.2 6.2l1-1.4-1.9-.9-.9.8a3.8 3.8 0 0 1-1.9-1.9l.8-.9-.9-1.9z" fill="currentColor" stroke="none"/>',
		'facebook'  => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
		'instagram' => '<rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.4A4 4 0 1 1 12.6 8 4 4 0 0 1 16 11.4z"/><path d="M17.5 6.5h.01"/>',
		'x'         => '<path d="M4 4l16 16M20 4 4 20"/>',
		'tiktok'    => '<path d="M9 12a4 4 0 1 0 4 4V3a5 5 0 0 0 5 5"/>',
		'linkedin'  => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>',
		'youtube'   => '<path d="M22.5 6.4a2.8 2.8 0 0 0-2-2C18.9 4 12 4 12 4s-6.9 0-8.6.4a2.8 2.8 0 0 0-2 2A29 29 0 0 0 1 11.8a29 29 0 0 0 .4 5.3 2.8 2.8 0 0 0 2 2C5.1 19.5 12 19.5 12 19.5s6.9 0 8.6-.4a2.8 2.8 0 0 0 2-2 29 29 0 0 0 .4-5.3 29 29 0 0 0-.5-5.400z"/><path d="m9.800 15 5.700-3.300L9.800 8.500z"/>',
		'spark'   => '<path d="m12 3 1.8 4.7 4.7 1.8-4.7 1.8L12 16l-1.8-4.7L5.5 9.5l4.7-1.8z"/><path d="m19 15 .8 2.2 2.2.8-2.2.8L19 21l-.8-2.2-2.2-.8 2.2-.8z"/>',
		'bolt'    => '<path d="M13 2 4 14h7l-1 8 9-12h-7z"/>',
		'chart'   => '<path d="M3 3v18h18"/><path d="m7 15 4-5 3 3 5-7"/>',
		'chat'    => '<path d="M21 12a8 8 0 0 1-11.5 7.2L3 21l1.8-5.5A8 8 0 1 1 21 12z"/>',
		'users'   => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/>',
		'arrow'   => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'pin'     => '<path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/>',
	);
	$p = isset( $icons[ $name ] ) ? $icons[ $name ] : '';
	return '<svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $p . '</svg>';
}

function cognicore_activities() {
	return array(
		array( 'title' => 'Integrated Solutions', 'icon' => 'layers', 'desc' => 'End-to-end projects that combine custom, AI-enhanced software with custom-built or carefully selected hardware, delivered and supported by one team.' ),
		array( 'title' => 'Software Development', 'icon' => 'code', 'desc' => 'Retail billing, procurement management, service and facility management systems, and e-commerce platforms, built around how your business operates and enhanced with custom AI tools.' ),
		array( 'title' => 'IT & Software Consultancy', 'icon' => 'bulb', 'desc' => 'Expert guidance on technology strategy, system selection, software architecture and where AI can add real value, so you invest in the right solution from the start.' ),
		array( 'title' => 'Hardware Distribution', 'icon' => 'printer', 'desc' => 'Printers, scanners, POS terminals, barcode scanners and related peripherals for retailers and enterprises.' ),
		array( 'title' => 'Digital Signage', 'icon' => 'screen', 'desc' => 'Smart displays for supermarkets and parking facilities: advertising, live price boards, guidance and information screens.' ),
		array( 'title' => 'General Trading', 'icon' => 'box', 'desc' => 'Sourcing and distribution of a broad portfolio of goods, tailored to client requirements.' ),
	);
}

function cognicore_ai_cards() {
	return array(
		array( 'icon' => 'bolt',  'title' => 'Smarter operations', 'desc' => 'Automate repetitive workflows, approvals and reporting so teams spend their time on decisions, not data entry.' ),
		array( 'icon' => 'chart', 'title' => 'Predictive insights', 'desc' => 'Demand forecasting and stock and procurement planning that turn your own data into clear, timely recommendations.' ),
		array( 'icon' => 'chat',  'title' => 'Intelligent assistants', 'desc' => 'Natural-language search and assistants built into your system, helping staff and customers find answers in seconds.' ),
		array( 'icon' => 'users', 'title' => 'Personalised experiences', 'desc' => 'Recommendations and tailored content for online stores and customer-facing screens, shaped by how people actually engage.' ),
	);
}

/** Shared "AI inside your software" section (home + services). */
function cognicore_ai_section() {
	?>
	<section class="section ai-section">
		<div class="container">
			<div class="ai-grid">
				<div class="reveal">
					<span class="badge"><?php echo cognicore_icon( 'spark' ); ?> AI-powered solutions</span>
					<h2 class="ai-h">Intelligence built into <span class="grad">your software.</span></h2>
					<p class="lead">AI is now part of how modern businesses compete. We embed custom AI tools directly inside the systems we build, so your operation runs more efficiently and every user, from your staff to your customers, gets more done with less effort.</p>
					<ul class="ticks">
						<li>Tailored to your workflows, not a generic add-on</li>
						<li>Works inside the software and devices you already use</li>
						<li>Practical gains in speed, accuracy and customer experience</li>
					</ul>
				</div>
				<div class="ai-cards">
					<?php foreach ( cognicore_ai_cards() as $c ) : ?>
						<article class="tile reveal"><span class="tile-ico"><?php echo cognicore_icon( $c['icon'] ); ?></span><h3><?php echo esc_html( $c['title'] ); ?></h3><p><?php echo esc_html( $c['desc'] ); ?></p></article>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<?php
}

function cognicore_maps_url() {
	return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( 'Dubai South Business Hub Free Zone – Business Setup Services in Dubai, UAE' );
}

function cognicore_address_html() {
	return esc_html( implode( ', ', cognicore_address_lines() ) );
}

add_shortcode( 'cognicore_address', function () {
	return '<div class="office-card"><h3>' . esc_html( COGNICORE_COMPANY ) . '</h3><p>' . implode( '<br>', array_map( 'esc_html', cognicore_address_lines() ) ) . '</p><a class="link-arrow" href="' . esc_url( cognicore_maps_url() ) . '" target="_blank" rel="noopener">Open in Maps ' . cognicore_icon( 'arrow' ) . '</a>' . cognicore_contact_rows() . cognicore_whatsapp_button() . cognicore_social_html( 'social-card' ) . '</div>';
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
		$to = is_email( cognicore_contact( 'email' ) ) ? cognicore_contact( 'email' ) : get_option( 'admin_email' );
		$ok = wp_mail(
			$to,
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
