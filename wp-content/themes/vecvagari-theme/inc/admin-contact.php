<?php
/**
 * LRM-134 / LRM-137: Contact info admin editor — WP Admin settings page.
 *
 * Provides a "Kontaktinformācija" settings page under WP Admin → Pages
 * for editing all contact details that appear on the contacts page and footer.
 *
 * Contact data is language-independent (same address / phone for all langs).
 * Values stored in a single wp_options entry:
 *   vv_contact  — associative array of contact fields
 *
 * Template helper:
 *   vv_contact( $key, $fallback )  — returns stored value or fallback string
 *
 * @package VecvagariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── Admin menu ────────────────────────────────────────────────────────────────

add_action( 'admin_menu', function () {
	add_submenu_page(
		'edit.php?post_type=page',
		'Kontaktinformācija',
		'Kontaktinformācija',
		'manage_options',
		'vecvagari-contact',
		'vecvagari_contact_admin_page'
	);
} );

// ── Save handler ──────────────────────────────────────────────────────────────

add_action( 'admin_post_vv_contact_save', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Unauthorized' );
	}
	check_admin_referer( 'vv_contact_save' );

	$text_fields = [
		'address',
		'email',
		'phone_office',
		'phone_properties',
		'phone_forestry',
		'phone_accounting',
		'working_hours',
		'legal_address',
		'reg_number',
	];

	$url_fields = [
		'maps_embed_url',
		'social_facebook',
		'social_instagram',
		'social_linkedin',
		'social_youtube',
	];

	$data = [];

	foreach ( $text_fields as $field ) {
		$data[ $field ] = sanitize_text_field( wp_unslash( $_POST[ $field ] ?? '' ) );
	}

	foreach ( $url_fields as $field ) {
		$data[ $field ] = esc_url_raw( wp_unslash( $_POST[ $field ] ?? '' ) );
	}

	update_option( 'vv_contact', $data, false );

	wp_redirect(
		add_query_arg(
			[ 'saved' => '1' ],
			admin_url( 'edit.php?post_type=page&page=vecvagari-contact' )
		)
	);
	exit;
} );

// ── Admin page renderer ───────────────────────────────────────────────────────

function vecvagari_contact_admin_page(): void {
	$opts = (array) get_option( 'vv_contact', [] );

	// Helper: field value with hardcoded default.
	$v = fn( string $key, string $default = '' ) => esc_attr( $opts[ $key ] ?? $default );
	?>
	<div class="wrap">
		<h1>Kontaktinformācija</h1>
		<p class="description">Šeit vari mainīt kontaktinformāciju, kas tiek rādīta kontaktu lapā un kājenē.</p>

		<?php if ( ! empty( $_GET['saved'] ) ) : ?>
			<div class="notice notice-success is-dismissible"><p>Saglabāts!</p></div>
		<?php endif; ?>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="vv_contact_save">
			<?php wp_nonce_field( 'vv_contact_save' ); ?>

			<h2>Biroja adrese un e-pasts</h2>
			<table class="form-table">
				<tr>
					<th><label for="vvc-address">Biroja adrese</label></th>
					<td>
						<input type="text" id="vvc-address" name="address" class="regular-text"
							value="<?php echo $v( 'address', 'Dzirnavu 13, Saldus, LV-3801' ); ?>">
						<p class="description">Tiek rādīta kontaktu lapā un kājenē.</p>
					</td>
				</tr>
				<tr>
					<th><label for="vvc-legal-address">Juridiskā adrese</label></th>
					<td>
						<input type="text" id="vvc-legal-address" name="legal_address" class="regular-text"
							value="<?php echo $v( 'legal_address', 'Saldus nov., Lutriņu pag., Kamiņi, Zaļā iela 1-3' ); ?>">
					</td>
				</tr>
				<tr>
					<th><label for="vvc-reg-number">Reģistrācijas numurs</label></th>
					<td>
						<input type="text" id="vvc-reg-number" name="reg_number" class="regular-text"
							value="<?php echo $v( 'reg_number', '48503010838' ); ?>">
					</td>
				</tr>
				<tr>
					<th><label for="vvc-email">E-pasts</label></th>
					<td>
						<input type="email" id="vvc-email" name="email" class="regular-text"
							value="<?php echo $v( 'email', 'info@vecvagari.com' ); ?>">
						<p class="description">Tiek rādīts kontaktu lapā un kājenē.</p>
					</td>
				</tr>
				<tr>
					<th><label for="vvc-working-hours">Darba laiks</label></th>
					<td>
						<input type="text" id="vvc-working-hours" name="working_hours" class="regular-text"
							value="<?php echo $v( 'working_hours', 'P–Pk 8:00–17:00' ); ?>">
						<p class="description">Piemēram: P–Pk 8:00–17:00</p>
					</td>
				</tr>
			</table>

			<h2>Tālruņi</h2>
			<table class="form-table">
				<tr>
					<th><label for="vvc-phone-office">Birojs</label></th>
					<td>
						<input type="text" id="vvc-phone-office" name="phone_office" class="regular-text"
							value="<?php echo $v( 'phone_office', '+371 25590827' ); ?>">
						<p class="description">Galvenais biroja tālrunis. Tiek rādīts kājenē.</p>
					</td>
				</tr>
				<tr>
					<th><label for="vvc-phone-properties">Meža īpašumi un cirsmas</label></th>
					<td>
						<input type="text" id="vvc-phone-properties" name="phone_properties" class="regular-text"
							value="<?php echo $v( 'phone_properties', '+371 28602441' ); ?>">
					</td>
				</tr>
				<tr>
					<th><label for="vvc-phone-forestry">Mežizstrādes pakalpojumi</label></th>
					<td>
						<input type="text" id="vvc-phone-forestry" name="phone_forestry" class="regular-text"
							value="<?php echo $v( 'phone_forestry', '+371 26554689' ); ?>">
					</td>
				</tr>
				<tr>
					<th><label for="vvc-phone-accounting">Grāmatvedība</label></th>
					<td>
						<input type="text" id="vvc-phone-accounting" name="phone_accounting" class="regular-text"
							value="<?php echo $v( 'phone_accounting', '+371 29215297' ); ?>">
					</td>
				</tr>
			</table>

			<h2>Google Maps</h2>
			<table class="form-table">
				<tr>
					<th><label for="vvc-maps-url">Maps embed URL</label></th>
					<td>
						<input type="url" id="vvc-maps-url" name="maps_embed_url" class="large-text"
							value="<?php echo $v( 'maps_embed_url', 'https://maps.google.com/maps?q=Dzirnavu+13%2C+Saldus%2C+LV-3801&t=m&z=14&output=embed&iwloc=near' ); ?>">
						<p class="description">Pilnais Google Maps embed URL (ar <code>output=embed</code>).</p>
					</td>
				</tr>
			</table>

			<h2>Sociālie tīkli</h2>
			<table class="form-table">
				<tr>
					<th><label for="vvc-facebook">Facebook URL</label></th>
					<td>
						<input type="url" id="vvc-facebook" name="social_facebook" class="regular-text"
							value="<?php echo $v( 'social_facebook', 'https://www.facebook.com/vecvagari' ); ?>">
					</td>
				</tr>
				<tr>
					<th><label for="vvc-instagram">Instagram URL</label></th>
					<td>
						<input type="url" id="vvc-instagram" name="social_instagram" class="regular-text"
							value="<?php echo $v( 'social_instagram', 'https://www.instagram.com/vecvagari' ); ?>">
					</td>
				</tr>
				<tr>
					<th><label for="vvc-linkedin">LinkedIn URL</label></th>
					<td>
						<input type="url" id="vvc-linkedin" name="social_linkedin" class="regular-text"
							value="<?php echo $v( 'social_linkedin', 'https://www.linkedin.com/company/vecvagari' ); ?>">
					</td>
				</tr>
				<tr>
					<th><label for="vvc-youtube">YouTube URL</label></th>
					<td>
						<input type="url" id="vvc-youtube" name="social_youtube" class="regular-text"
							value="<?php echo $v( 'social_youtube', 'https://www.youtube.com/@vecvagari' ); ?>">
					</td>
				</tr>
			</table>

			<?php submit_button( 'Saglabāt izmaiņas' ); ?>
		</form>
	</div>
	<?php
}
