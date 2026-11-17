<?php
/**
 * Theme colours: presets + custom overrides.
 * Edit in WP Admin: Appearance > Theme Colors.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

const COGNICORE_COLORS_OPTION = 'cognicore_colors';

function cognicore_palettes() {
	return array(
		'midnight_blue' => array( 'name' => 'Midnight Blue (default)', 'bg' => '#070b16', 'bg2' => '#0b1224', 'bg3' => '#0e1730', 'text' => '#e8ecf5', 'accent' => '#3b82f6', 'accent2' => '#22d3ee', 'accent3' => '#8b5cf6', 'gold' => '#e6c27a' ),
		'emerald_night' => array( 'name' => 'Emerald Night',          'bg' => '#06110e', 'bg2' => '#0a1a15', 'bg3' => '#0d221b', 'text' => '#e6f4ee', 'accent' => '#10b981', 'accent2' => '#2dd4bf', 'accent3' => '#3b82f6', 'gold' => '#e6c27a' ),
		'royal_violet'  => array( 'name' => 'Royal Violet',           'bg' => '#0b0716', 'bg2' => '#120b24', 'bg3' => '#190f33', 'text' => '#efeaf8', 'accent' => '#8b5cf6', 'accent2' => '#d946ef', 'accent3' => '#6366f1', 'gold' => '#f0c987' ),
		'dubai_gold'    => array( 'name' => 'Dubai Gold',             'bg' => '#0a0a0c', 'bg2' => '#121214', 'bg3' => '#19191c', 'text' => '#f3efe6', 'accent' => '#d4a64a', 'accent2' => '#f0d28a', 'accent3' => '#b8862f', 'gold' => '#f0d28a' ),
		'crimson_dark'  => array( 'name' => 'Crimson Dark',           'bg' => '#0f0709', 'bg2' => '#170b0e', 'bg3' => '#1f1013', 'text' => '#f5e9ea', 'accent' => '#ef4444', 'accent2' => '#fb923c', 'accent3' => '#db2777', 'gold' => '#f0c987' ),
		'clean_light'   => array( 'name' => 'Clean Light',            'bg' => '#f7f9fc', 'bg2' => '#eaeff8', 'bg3' => '#ffffff', 'text' => '#0f172a', 'accent' => '#2563eb', 'accent2' => '#0891b2', 'accent3' => '#7c3aed', 'gold' => '#a16207' ),
		'sand_light'    => array( 'name' => 'Warm Sand Light',        'bg' => '#fbf8f3', 'bg2' => '#f2ebdf', 'bg3' => '#ffffff', 'text' => '#1c1917', 'accent' => '#c2410c', 'accent2' => '#d97706', 'accent3' => '#be123c', 'gold' => '#92400e' ),
	);
}

function cognicore_color_fields() {
	return array(
		'bg'      => 'Page background',
		'text'    => 'Text',
		'accent'  => 'Main accent (buttons, links)',
		'accent2' => 'Gradient start',
		'accent3' => 'Gradient end',
		'gold'    => 'Small highlight (labels)',
	);
}

function cognicore_colors_settings() {
	$o = (array) get_option( COGNICORE_COLORS_OPTION, array() );
	return array(
		'preset' => isset( $o['preset'] ) ? $o['preset'] : 'midnight_blue',
		'custom' => isset( $o['custom'] ) && is_array( $o['custom'] ) ? $o['custom'] : array(),
	);
}

function cognicore_hex_rgb( $hex ) {
	$hex = ltrim( (string) $hex, '#' );
	if ( 3 === strlen( $hex ) ) { $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2]; }
	return array( hexdec( substr( $hex, 0, 2 ) ), hexdec( substr( $hex, 2, 2 ) ), hexdec( substr( $hex, 4, 2 ) ) );
}

function cognicore_rgb_str( $hex ) {
	return implode( ',', cognicore_hex_rgb( $hex ) );
}

function cognicore_mix( $a, $b, $t ) {
	$x = cognicore_hex_rgb( $a );
	$y = cognicore_hex_rgb( $b );
	$o = '#';
	for ( $i = 0; $i < 3; $i++ ) {
		$o .= str_pad( dechex( (int) round( $x[ $i ] * ( 1 - $t ) + $y[ $i ] * $t ) ), 2, '0', STR_PAD_LEFT );
	}
	return $o;
}

function cognicore_luminance( $hex ) {
	list( $r, $g, $b ) = cognicore_hex_rgb( $hex );
	return ( 0.2126 * $r + 0.7152 * $g + 0.0722 * $b ) / 255;
}

/** Final colours = chosen preset + any custom overrides, with derived shades. */
function cognicore_resolved_colors() {
	$s       = cognicore_colors_settings();
	$presets = cognicore_palettes();
	$c       = isset( $presets[ $s['preset'] ] ) ? $presets[ $s['preset'] ] : $presets['midnight_blue'];
	$custom  = array();
	foreach ( array_keys( cognicore_color_fields() ) as $k ) {
		if ( ! empty( $s['custom'][ $k ] ) && sanitize_hex_color( $s['custom'][ $k ] ) ) {
			$custom[ $k ] = sanitize_hex_color( $s['custom'][ $k ] );
		}
	}
	$c = array_merge( $c, $custom );
	$dark = cognicore_luminance( $c['bg'] ) < 0.5;
	$ink  = $dark ? '#ffffff' : '#0f172a';
	if ( isset( $custom['bg'] ) ) {
		$c['bg2'] = cognicore_mix( $c['bg'], $ink, 0.04 );
		$c['bg3'] = cognicore_mix( $c['bg'], $ink, $dark ? 0.08 : 0.0 );
		if ( ! $dark ) { $c['bg3'] = '#ffffff'; }
	}
	$c['dark']      = $dark;
	$c['ink']       = $ink;
	$c['muted']     = cognicore_mix( $c['text'], $c['bg'], 0.42 );
	$c['text2']     = cognicore_mix( $c['text'], $c['bg'], 0.18 );
	$c['on_accent'] = cognicore_luminance( $c['accent'] ) > 0.55 ? '#0b1020' : '#ffffff';
	$c['cta_a']     = cognicore_mix( $c['accent'], '#000000', 0.5 );
	$c['cta_b']     = cognicore_mix( $c['accent3'], '#000000', 0.55 );
	return $c;
}

function cognicore_color( $key ) {
	$c = cognicore_resolved_colors();
	return isset( $c[ $key ] ) ? $c[ $key ] : '';
}

function cognicore_colors_css() {
	$c   = cognicore_resolved_colors();
	$css = ':root{'
		. '--bg:' . $c['bg'] . ';--bg2:' . $c['bg2'] . ';--bg3:' . $c['bg3'] . ';'
		. '--text:' . $c['text'] . ';--text-2:' . $c['text2'] . ';--muted:' . $c['muted'] . ';'
		. '--accent:' . $c['accent'] . ';--accent2:' . $c['accent2'] . ';--accent3:' . $c['accent3'] . ';--gold:' . $c['gold'] . ';'
		. '--bg-rgb:' . cognicore_rgb_str( $c['bg'] ) . ';--win-rgb:' . cognicore_rgb_str( $c['bg3'] ) . ';'
		. '--accent-rgb:' . cognicore_rgb_str( $c['accent'] ) . ';--accent2-rgb:' . cognicore_rgb_str( $c['accent2'] ) . ';--accent3-rgb:' . cognicore_rgb_str( $c['accent3'] ) . ';--gold-rgb:' . cognicore_rgb_str( $c['gold'] ) . ';'
		. '--ink-rgb:' . cognicore_rgb_str( $c['ink'] ) . ';'
		. '--on-accent:' . $c['on_accent'] . ';--cta-a:' . $c['cta_a'] . ';--cta-b:' . $c['cta_b'] . ';'
		. 'color-scheme:' . ( $c['dark'] ? 'dark' : 'light' ) . ';}';
	return $css;
}

add_action( 'wp_enqueue_scripts', function () {
	wp_add_inline_style( 'cognicore-style', cognicore_colors_css() );
}, 30 );

/* ---------- Admin ---------- */
add_action( 'admin_init', function () {
	register_setting( 'cognicore_colors_group', COGNICORE_COLORS_OPTION, array(
		'type'              => 'array',
		'sanitize_callback' => function ( $in ) {
			$in      = is_array( $in ) ? $in : array();
			$presets = cognicore_palettes();
			$out     = array(
				'preset' => isset( $in['preset'], $presets[ $in['preset'] ] ) ? $in['preset'] : 'midnight_blue',
				'custom' => array(),
			);
			foreach ( array_keys( cognicore_color_fields() ) as $k ) {
				$v = isset( $in['custom'][ $k ] ) ? sanitize_hex_color( $in['custom'][ $k ] ) : '';
				if ( $v ) { $out['custom'][ $k ] = $v; }
			}
			return $out;
		},
	) );
} );

add_action( 'admin_menu', function () {
	add_theme_page( 'Theme Colors', 'Theme Colors', 'manage_options', 'cognicore-colors', 'cognicore_colors_page' );
} );

add_action( 'admin_enqueue_scripts', function ( $hook ) {
	if ( 'appearance_page_cognicore-colors' !== $hook ) { return; }
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_add_inline_script( 'wp-color-picker', 'jQuery(function($){$(".cc-color").wpColorPicker();});' );
} );

function cognicore_colors_page() {
	if ( ! current_user_can( 'manage_options' ) ) { return; }
	$n = COGNICORE_COLORS_OPTION;
	$s = cognicore_colors_settings();
	?>
	<div class="wrap">
		<h1>Theme Colors</h1>
		<p>Choose a ready-made palette, then optionally fine-tune individual colours below. Dark and light palettes are both available.</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'cognicore_colors_group' ); ?>
			<h2>1. Palette</h2>
			<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:14px;max-width:960px">
			<?php foreach ( cognicore_palettes() as $id => $p ) : ?>
				<label style="display:block;border:2px solid <?php echo $s['preset'] === $id ? '#2271b1' : '#c3c4c7'; ?>;border-radius:10px;padding:12px;background:#fff;cursor:pointer">
					<input type="radio" name="<?php echo esc_attr( $n ); ?>[preset]" value="<?php echo esc_attr( $id ); ?>" <?php checked( $s['preset'], $id ); ?>>
					<strong><?php echo esc_html( $p['name'] ); ?></strong>
					<span style="display:flex;height:34px;margin-top:10px;border-radius:6px;overflow:hidden;border:1px solid #dcdcde">
						<?php foreach ( array( 'bg', 'bg3', 'text', 'accent', 'accent2', 'accent3', 'gold' ) as $k ) : ?>
							<i style="flex:1;background:<?php echo esc_attr( $p[ $k ] ); ?>"></i>
						<?php endforeach; ?>
					</span>
				</label>
			<?php endforeach; ?>
			</div>

			<h2 style="margin-top:28px">2. Custom colours (optional)</h2>
			<p>Pick a colour to override the palette. Leave a field empty to keep the palette's colour. Choosing a light page background switches the site to light mode automatically.</p>
			<table class="form-table" role="presentation">
			<?php foreach ( cognicore_color_fields() as $k => $label ) : ?>
				<tr>
					<th scope="row"><?php echo esc_html( $label ); ?></th>
					<td><input type="text" class="cc-color" name="<?php echo esc_attr( $n ); ?>[custom][<?php echo esc_attr( $k ); ?>]" value="<?php echo esc_attr( isset( $s['custom'][ $k ] ) ? $s['custom'][ $k ] : '' ); ?>" data-default-color=""></td>
				</tr>
			<?php endforeach; ?>
			</table>
			<?php submit_button( 'Save colours' ); ?>
		</form>
	</div>
	<?php
}
