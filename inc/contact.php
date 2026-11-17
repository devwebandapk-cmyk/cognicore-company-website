<?php
/**
 * Company contact details: admin settings page + front-end helpers.
 * Edit in WP Admin: Settings > Company Contact.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

const COGNICORE_CONTACT_OPTION = 'cognicore_contact';

function cognicore_contact_defaults() {
	return array(
		'phone'       => '',
		'whatsapp'    => '',
		'wa_message'  => 'Hello Cognicore Technologies, I would like to know more about your solutions.',
		'email'       => '',
		'wa_floating' => 1,
	);
}

function cognicore_contact( $key ) {
	$opts = wp_parse_args( (array) get_option( COGNICORE_CONTACT_OPTION, array() ), cognicore_contact_defaults() );
	return isset( $opts[ $key ] ) ? $opts[ $key ] : '';
}

function cognicore_contact_sanitize( $in ) {
	$in = is_array( $in ) ? $in : array();
	return array(
		'phone'       => sanitize_text_field( $in['phone'] ?? '' ),
		'whatsapp'    => preg_replace( '/\D+/', '', (string) ( $in['whatsapp'] ?? '' ) ),
		'wa_message'  => sanitize_text_field( $in['wa_message'] ?? '' ),
		'email'       => sanitize_email( $in['email'] ?? '' ),
		'wa_floating' => empty( $in['wa_floating'] ) ? 0 : 1,
	);
}

/* ---------- Admin page ---------- */
add_action( 'admin_init', function () {
	register_setting( 'cognicore_contact_group', COGNICORE_CONTACT_OPTION, array(
		'type'              => 'array',
		'sanitize_callback' => 'cognicore_contact_sanitize',
		'default'           => cognicore_contact_defaults(),
	) );
} );

add_action( 'admin_menu', function () {
	add_options_page( 'Company Contact', 'Company Contact', 'manage_options', 'cognicore-contact', 'cognicore_contact_page' );
} );

function cognicore_contact_page() {
	if ( ! current_user_can( 'manage_options' ) ) { return; }
	$n = COGNICORE_CONTACT_OPTION;
	?>
	<div class="wrap">
		<h1>Company Contact</h1>
		<p>These details appear in the website footer, on the Contact page and on the WhatsApp button. Leave a field empty to hide it.</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'cognicore_contact_group' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="cc_phone">Mobile / phone number</label></th>
					<td><input id="cc_phone" class="regular-text" type="text" name="<?php echo esc_attr( $n ); ?>[phone]" value="<?php echo esc_attr( cognicore_contact( 'phone' ) ); ?>" placeholder="+971 5X XXX XXXX">
					<p class="description">Shown exactly as typed. Tapping it starts a phone call on mobile.</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="cc_wa">WhatsApp number</label></th>
					<td><input id="cc_wa" class="regular-text" type="text" name="<?php echo esc_attr( $n ); ?>[whatsapp]" value="<?php echo esc_attr( cognicore_contact( 'whatsapp' ) ); ?>" placeholder="9715XXXXXXXX">
					<p class="description">Country code first, digits only, no + or spaces (for example 9715XXXXXXXX).</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="cc_msg">WhatsApp greeting</label></th>
					<td><input id="cc_msg" class="large-text" type="text" name="<?php echo esc_attr( $n ); ?>[wa_message]" value="<?php echo esc_attr( cognicore_contact( 'wa_message' ) ); ?>">
					<p class="description">The message that is pre-filled when a visitor opens WhatsApp.</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="cc_email">Email address</label></th>
					<td><input id="cc_email" class="regular-text" type="email" name="<?php echo esc_attr( $n ); ?>[email]" value="<?php echo esc_attr( cognicore_contact( 'email' ) ); ?>" placeholder="info@yourcompany.com">
					<p class="description">Shown on the site. Contact form messages are also sent to this address (the site admin email is used if empty).</p></td>
				</tr>
				<tr>
					<th scope="row">Floating WhatsApp button</th>
					<td><label><input type="checkbox" name="<?php echo esc_attr( $n ); ?>[wa_floating]" value="1" <?php checked( 1, (int) cognicore_contact( 'wa_floating' ) ); ?>> Show the round WhatsApp button at the bottom-right of every page</label></td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/* ---------- Front-end helpers ---------- */
function cognicore_tel_href() {
	$p = preg_replace( '/[^\d+]/', '', (string) cognicore_contact( 'phone' ) );
	return $p ? 'tel:' . $p : '';
}

function cognicore_wa_url() {
	$n = preg_replace( '/\D+/', '', (string) cognicore_contact( 'whatsapp' ) );
	if ( ! $n ) { return ''; }
	$msg = (string) cognicore_contact( 'wa_message' );
	return 'https://wa.me/' . $n . ( $msg ? '?text=' . rawurlencode( $msg ) : '' );
}

function cognicore_whatsapp_button( $label = 'Chat on WhatsApp', $class = 'btn btn-wa' ) {
	$url = cognicore_wa_url();
	if ( ! $url ) { return ''; }
	return '<a class="' . esc_attr( $class ) . '" href="' . esc_url( $url ) . '" target="_blank" rel="noopener">' . cognicore_icon( 'whatsapp' ) . esc_html( $label ) . '</a>';
}

/** Phone + email rows (empty string when nothing is set). */
function cognicore_contact_rows() {
	$out   = '';
	$phone = cognicore_contact( 'phone' );
	$email = cognicore_contact( 'email' );
	if ( $phone ) {
		$out .= '<li>' . cognicore_icon( 'phone' ) . '<a href="' . esc_url( cognicore_tel_href() ) . '">' . esc_html( $phone ) . '</a></li>';
	}
	if ( $email ) {
		$out .= '<li>' . cognicore_icon( 'mail' ) . '<a href="mailto:' . esc_attr( antispambot( $email ) ) . '">' . esc_html( antispambot( $email ) ) . '</a></li>';
	}
	return $out ? '<ul class="contact-rows">' . $out . '</ul>' : '';
}
