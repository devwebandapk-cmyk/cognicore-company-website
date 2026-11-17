<?php
/**
 * SMTP email settings + test email.
 * Edit in WP Admin: Settings > Email (SMTP).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

const COGNICORE_SMTP_OPTION = 'cognicore_smtp';

function cognicore_smtp_defaults() {
	return array(
		'enabled'    => 0,
		'host'       => '',
		'port'       => 587,
		'encryption' => 'tls',
		'auth'       => 1,
		'username'   => '',
		'password'   => '',
		'from_email' => '',
		'from_name'  => '',
	);
}

function cognicore_smtp( $key ) {
	$o = wp_parse_args( (array) get_option( COGNICORE_SMTP_OPTION, array() ), cognicore_smtp_defaults() );
	if ( 'password' === $key && defined( 'COGNICORE_SMTP_PASS' ) ) {
		return COGNICORE_SMTP_PASS;
	}
	return isset( $o[ $key ] ) ? $o[ $key ] : '';
}

/* ---------- Send through SMTP ---------- */
add_action( 'phpmailer_init', function ( $mailer ) {
	if ( ! cognicore_smtp( 'enabled' ) || ! cognicore_smtp( 'host' ) ) { return; }
	$mailer->isSMTP();
	$mailer->Host       = cognicore_smtp( 'host' );
	$mailer->Port       = (int) cognicore_smtp( 'port' );
	$enc                = cognicore_smtp( 'encryption' );
	$mailer->SMTPSecure = in_array( $enc, array( 'ssl', 'tls' ), true ) ? $enc : '';
	$mailer->SMTPAutoTLS = in_array( $enc, array( 'ssl', 'tls' ), true );
	if ( cognicore_smtp( 'auth' ) ) {
		$mailer->SMTPAuth = true;
		$mailer->Username = cognicore_smtp( 'username' );
		$mailer->Password = cognicore_smtp( 'password' );
	} else {
		$mailer->SMTPAuth = false;
	}
} );

add_filter( 'wp_mail_from', function ( $email ) {
	return ( cognicore_smtp( 'enabled' ) && is_email( cognicore_smtp( 'from_email' ) ) ) ? cognicore_smtp( 'from_email' ) : $email;
} );
add_filter( 'wp_mail_from_name', function ( $name ) {
	return ( cognicore_smtp( 'enabled' ) && cognicore_smtp( 'from_name' ) ) ? cognicore_smtp( 'from_name' ) : $name;
} );

/* ---------- Admin ---------- */
add_action( 'admin_init', function () {
	register_setting( 'cognicore_smtp_group', COGNICORE_SMTP_OPTION, array(
		'type'              => 'array',
		'sanitize_callback' => function ( $in ) {
			$in  = is_array( $in ) ? $in : array();
			$old = (array) get_option( COGNICORE_SMTP_OPTION, array() );
			$pw  = isset( $in['password'] ) ? (string) wp_unslash( $in['password'] ) : '';
			return array(
				'enabled'    => empty( $in['enabled'] ) ? 0 : 1,
				'host'       => sanitize_text_field( $in['host'] ?? '' ),
				'port'       => max( 1, min( 65535, (int) ( $in['port'] ?? 587 ) ) ),
				'encryption' => in_array( $in['encryption'] ?? '', array( 'none', 'ssl', 'tls' ), true ) ? $in['encryption'] : 'tls',
				'auth'       => empty( $in['auth'] ) ? 0 : 1,
				'username'   => sanitize_text_field( $in['username'] ?? '' ),
				// Blank password keeps the one already saved.
				'password'   => '' !== $pw ? $pw : ( $old['password'] ?? '' ),
				'from_email' => sanitize_email( $in['from_email'] ?? '' ),
				'from_name'  => sanitize_text_field( $in['from_name'] ?? '' ),
			);
		},
	) );
} );

add_action( 'admin_menu', function () {
	add_options_page( 'Email (SMTP)', 'Email (SMTP)', 'manage_options', 'cognicore-smtp', 'cognicore_smtp_page' );
} );

add_action( 'admin_post_cognicore_smtp_test', function () {
	if ( ! current_user_can( 'manage_options' ) || ! check_admin_referer( 'cognicore_smtp_test' ) ) { wp_die( 'Not allowed.' ); }
	$to    = sanitize_email( wp_unslash( $_POST['test_to'] ?? '' ) );
	$error = '';
	add_action( 'wp_mail_failed', function ( $e ) use ( &$error ) { $error = $e->get_error_message(); } );
	$ok = is_email( $to ) && wp_mail( $to, 'Test email from ' . get_bloginfo( 'name' ), "This is a test message sent from the Cognicore theme.\n\nIf you can read this, your email settings work." );
	set_transient( 'cognicore_smtp_test_result', array(
		'ok'  => (bool) $ok,
		'msg' => $ok ? 'Test email sent to ' . $to . '. Check the inbox (and spam folder).' : ( is_email( $to ) ? 'Sending failed: ' . ( $error ? $error : 'unknown error.' ) : 'Please enter a valid email address for the test.' ),
	), 60 );
	wp_safe_redirect( admin_url( 'options-general.php?page=cognicore-smtp' ) );
	exit;
} );

function cognicore_smtp_page() {
	if ( ! current_user_can( 'manage_options' ) ) { return; }
	$n   = COGNICORE_SMTP_OPTION;
	$res = get_transient( 'cognicore_smtp_test_result' );
	if ( $res ) { delete_transient( 'cognicore_smtp_test_result' ); }
	?>
	<div class="wrap">
		<h1>Email (SMTP)</h1>
		<p>Send website emails (such as contact form messages) through your own mail server so they arrive reliably. Without this, WordPress uses the web server's basic mail, which is often blocked or sent to spam.</p>
		<?php if ( $res ) : ?>
			<div class="notice notice-<?php echo $res['ok'] ? 'success' : 'error'; ?>"><p><?php echo esc_html( $res['msg'] ); ?></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'cognicore_smtp_group' ); ?>
			<table class="form-table" role="presentation">
				<tr><th scope="row">Use SMTP</th>
					<td><label><input type="checkbox" name="<?php echo esc_attr( $n ); ?>[enabled]" value="1" <?php checked( 1, (int) cognicore_smtp( 'enabled' ) ); ?>> Send all website email through the server below</label></td></tr>
				<tr><th scope="row"><label for="s_host">SMTP host</label></th>
					<td><input id="s_host" class="regular-text" type="text" name="<?php echo esc_attr( $n ); ?>[host]" value="<?php echo esc_attr( cognicore_smtp( 'host' ) ); ?>" placeholder="smtp.example.com"></td></tr>
				<tr><th scope="row"><label for="s_port">Port</label></th>
					<td><input id="s_port" class="small-text" type="number" name="<?php echo esc_attr( $n ); ?>[port]" value="<?php echo esc_attr( cognicore_smtp( 'port' ) ); ?>">
					<p class="description">Usually 587 (TLS) or 465 (SSL).</p></td></tr>
				<tr><th scope="row"><label for="s_enc">Encryption</label></th>
					<td><select id="s_enc" name="<?php echo esc_attr( $n ); ?>[encryption]">
						<?php foreach ( array( 'tls' => 'TLS (STARTTLS)', 'ssl' => 'SSL', 'none' => 'None' ) as $v => $l ) : ?>
							<option value="<?php echo esc_attr( $v ); ?>" <?php selected( cognicore_smtp( 'encryption' ), $v ); ?>><?php echo esc_html( $l ); ?></option>
						<?php endforeach; ?>
					</select></td></tr>
				<tr><th scope="row">Authentication</th>
					<td><label><input type="checkbox" name="<?php echo esc_attr( $n ); ?>[auth]" value="1" <?php checked( 1, (int) cognicore_smtp( 'auth' ) ); ?>> The server requires a username and password</label></td></tr>
				<tr><th scope="row"><label for="s_user">Username</label></th>
					<td><input id="s_user" class="regular-text" type="text" autocomplete="off" name="<?php echo esc_attr( $n ); ?>[username]" value="<?php echo esc_attr( cognicore_smtp( 'username' ) ); ?>" placeholder="usually your full email address"></td></tr>
				<tr><th scope="row"><label for="s_pass">Password</label></th>
					<td><input id="s_pass" class="regular-text" type="password" autocomplete="new-password" name="<?php echo esc_attr( $n ); ?>[password]" value="" placeholder="<?php echo cognicore_smtp( 'password' ) ? '(saved, leave blank to keep)' : ''; ?>">
					<p class="description">For Gmail or Microsoft 365 use an <em>app password</em>, not your normal password. For extra safety you can instead add <code>define( 'COGNICORE_SMTP_PASS', 'your-password' );</code> to <code>wp-config.php</code>, which takes priority over this field.</p></td></tr>
				<tr><th scope="row"><label for="s_from">From email</label></th>
					<td><input id="s_from" class="regular-text" type="email" name="<?php echo esc_attr( $n ); ?>[from_email]" value="<?php echo esc_attr( cognicore_smtp( 'from_email' ) ); ?>" placeholder="info@yourcompany.com">
					<p class="description">Should be an address your mail server allows you to send from.</p></td></tr>
				<tr><th scope="row"><label for="s_fname">From name</label></th>
					<td><input id="s_fname" class="regular-text" type="text" name="<?php echo esc_attr( $n ); ?>[from_name]" value="<?php echo esc_attr( cognicore_smtp( 'from_name' ) ); ?>" placeholder="Cognicore Technologies"></td></tr>
			</table>
			<?php submit_button(); ?>
		</form>

		<hr>
		<h2>Send a test email</h2>
		<p>Save your settings first, then send a test to confirm everything works.</p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="cognicore_smtp_test">
			<?php wp_nonce_field( 'cognicore_smtp_test' ); ?>
			<input class="regular-text" type="email" name="test_to" placeholder="you@example.com" value="<?php echo esc_attr( wp_get_current_user()->user_email ); ?>">
			<?php submit_button( 'Send test email', 'secondary', 'submit', false ); ?>
		</form>

		<hr>
		<h2>Common settings</h2>
		<table class="widefat striped" style="max-width:760px">
			<thead><tr><th>Provider</th><th>Host</th><th>Port / encryption</th><th>Notes</th></tr></thead>
			<tbody>
				<tr><td>Gmail / Google Workspace</td><td>smtp.gmail.com</td><td>587 TLS</td><td>Requires an app password</td></tr>
				<tr><td>Microsoft 365</td><td>smtp.office365.com</td><td>587 TLS</td><td>SMTP AUTH must be enabled for the mailbox</td></tr>
				<tr><td>Zoho Mail</td><td>smtp.zoho.com</td><td>587 TLS or 465 SSL</td><td>Use .eu / .in host for those regions</td></tr>
				<tr><td>Your web host</td><td>mail.yourdomain.com</td><td>587 TLS or 465 SSL</td><td>Create a mailbox in your hosting panel first</td></tr>
			</tbody>
		</table>
	</div>
	<?php
}
