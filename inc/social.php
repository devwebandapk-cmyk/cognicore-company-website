<?php
/**
 * Social media links. Edit in WP Admin: Settings > Social Media.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

const COGNICORE_SOCIAL_OPTION = 'cognicore_social';

function cognicore_social_networks() {
	return array(
		'facebook'  => array( 'Facebook',  'https://www.facebook.com/yourpage' ),
		'instagram' => array( 'Instagram', 'https://www.instagram.com/yourhandle' ),
		'x'         => array( 'X (Twitter)', 'https://x.com/yourhandle' ),
		'tiktok'    => array( 'TikTok',    'https://www.tiktok.com/@yourhandle' ),
		'linkedin'  => array( 'LinkedIn',  'https://www.linkedin.com/company/yourcompany' ),
		'youtube'   => array( 'YouTube',   'https://www.youtube.com/@yourchannel' ),
	);
}

function cognicore_social_links() {
	$o   = (array) get_option( COGNICORE_SOCIAL_OPTION, array() );
	$out = array();
	foreach ( cognicore_social_networks() as $k => $n ) {
		if ( ! empty( $o[ $k ] ) ) { $out[ $k ] = $o[ $k ]; }
	}
	return $out;
}

/** Row of round social icons (empty string if none are set). */
function cognicore_social_html( $class = '' ) {
	$links = cognicore_social_links();
	if ( ! $links ) { return ''; }
	$nets = cognicore_social_networks();
	$h    = '<ul class="social ' . esc_attr( $class ) . '">';
	foreach ( $links as $k => $url ) {
		$h .= '<li><a href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( $nets[ $k ][0] ) . '">' . cognicore_icon( $k ) . '</a></li>';
	}
	return $h . '</ul>';
}

add_action( 'admin_init', function () {
	register_setting( 'cognicore_social_group', COGNICORE_SOCIAL_OPTION, array(
		'type'              => 'array',
		'sanitize_callback' => function ( $in ) {
			$in  = is_array( $in ) ? $in : array();
			$out = array();
			foreach ( array_keys( cognicore_social_networks() ) as $k ) {
				$out[ $k ] = isset( $in[ $k ] ) ? esc_url_raw( trim( $in[ $k ] ) ) : '';
			}
			return $out;
		},
	) );
} );

add_action( 'admin_menu', function () {
	add_options_page( 'Social Media', 'Social Media', 'manage_options', 'cognicore-social', function () {
		if ( ! current_user_can( 'manage_options' ) ) { return; }
		$o = (array) get_option( COGNICORE_SOCIAL_OPTION, array() );
		?>
		<div class="wrap">
			<h1>Social Media</h1>
			<p>Paste the full link to each page or profile. Icons appear in the website footer and on the Contact page. Leave a field empty to hide that icon.</p>
			<form method="post" action="options.php">
				<?php settings_fields( 'cognicore_social_group' ); ?>
				<table class="form-table" role="presentation">
				<?php foreach ( cognicore_social_networks() as $k => $n ) : ?>
					<tr>
						<th scope="row"><label for="soc_<?php echo esc_attr( $k ); ?>"><?php echo esc_html( $n[0] ); ?></label></th>
						<td><input id="soc_<?php echo esc_attr( $k ); ?>" class="large-text" type="url" name="<?php echo esc_attr( COGNICORE_SOCIAL_OPTION ); ?>[<?php echo esc_attr( $k ); ?>]" value="<?php echo esc_attr( isset( $o[ $k ] ) ? $o[ $k ] : '' ); ?>" placeholder="<?php echo esc_attr( $n[1] ); ?>"></td>
					</tr>
				<?php endforeach; ?>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	} );
} );
