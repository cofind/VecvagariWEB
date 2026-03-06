<?php
/**
 * LRM-124: Vakances — job listings page.
 * LRM-125: Application modal added — each card triggers inline form.
 * LRM-126: Multilingual — all strings use vv_t().
 *
 * Loaded automatically for the page with slug "vakances".
 * Queries published vakance posts where expiry date >= today.
 *
 * @package VecvagariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$today    = date( 'Y-m-d' );
$vakances = get_posts( [
	'post_type'      => 'vakance',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'meta_value',
	'meta_key'       => 'vak_beigu_datums',
	'order'          => 'ASC',
	'meta_query'     => [ [
		'key'     => 'vak_beigu_datums',
		'value'   => $today,
		'compare' => '>=',
		'type'    => 'DATE',
	] ],
] );
?>

<main id="content" class="vv-vakances-page">

	<!-- ── Hero ── -->
	<section class="vv-sp-hero">
		<div class="vv-sp-inner">
			<nav class="vv-sp-breadcrumb" aria-label="<?php echo esc_attr( vv_t( 'Navigācijas ceļš', 'Breadcrumb', 'Brödsmula' ) ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( vv_t( 'SĀKUMLAPA', 'HOME', 'HEM' ) ); ?></a>
				<span class="vv-sp-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
				<span><?php echo esc_html( vv_t( 'VAKANCES', 'VACANCIES', 'LEDIGA TJÄNSTER' ) ); ?></span>
			</nav>
			<h1 class="vv-sp-h1"><?php echo esc_html( vv_t( 'Vakances', 'Vacancies', 'Lediga tjänster' ) ); ?></h1>
			<p class="vv-sp-subtitle"><?php echo esc_html( vv_t( 'Pievienojieties Vecvagari M komandai — mežizstrādes profesionāļu vidū', 'Join the Vecvagari M team — among forestry professionals', 'Gå med i Vecvagari M-teamet — bland skogsproffs' ) ); ?></p>
		</div>
	</section>

	<!-- ── Listings ── -->
	<section class="vv-vak-section">
		<div class="vv-vak-inner">

			<?php if ( $vakances ) : ?>

				<div class="vv-vak-grid" role="list">
					<?php foreach ( $vakances as $vak ) :
						$vieta         = get_post_meta( $vak->ID, 'vak_vieta', true );
						$nodarbinasana = get_post_meta( $vak->ID, 'vak_nodarbinasana', true );
						$atalgojums    = get_post_meta( $vak->ID, 'vak_atalgojums', true );
						$apraksts      = get_post_meta( $vak->ID, 'vak_apraksts', true );
						$prasibas      = get_post_meta( $vak->ID, 'vak_prasibas', true );
						$piedavajam    = get_post_meta( $vak->ID, 'vak_piedavajam', true );
						$kontakts      = get_post_meta( $vak->ID, 'vak_kontakts', true );
						$has_details   = $apraksts || $prasibas || $piedavajam || $kontakts;
						$details_id    = 'vak-details-' . absint( $vak->ID );
					?>
					<article class="vv-vak-card" role="listitem">

						<div class="vv-vak-card__top">
							<h2 class="vv-vak-card__title"><?php echo esc_html( $vak->post_title ); ?></h2>

							<?php if ( $vieta || $nodarbinasana ) : ?>
							<p class="vv-vak-card__meta">
								<?php if ( $vieta ) : ?>
									<span class="vv-vak-card__meta-item">
										<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
										<?php echo esc_html( $vieta ); ?>
									</span>
								<?php endif; ?>
								<?php if ( $vieta && $nodarbinasana ) : ?>
									<span class="vv-vak-card__meta-sep" aria-hidden="true">&bull;</span>
								<?php endif; ?>
								<?php if ( $nodarbinasana ) : ?>
									<span class="vv-vak-card__meta-item">
										<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
										<?php echo esc_html( $nodarbinasana ); ?>
									</span>
								<?php endif; ?>
							</p>
							<?php endif; ?>

							<?php if ( $atalgojums ) : ?>
							<p class="vv-vak-card__salary">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
								<?php echo esc_html( $atalgojums ); ?>
							</p>
							<?php endif; ?>
						</div>

						<div class="vv-vak-card__actions">
							<?php if ( $has_details ) : ?>
							<button
								class="vv-vak-btn vv-vak-btn--details"
								aria-expanded="false"
								aria-controls="<?php echo esc_attr( $details_id ); ?>">
								<?php echo esc_html( vv_t( 'Lasīt vairāk', 'Read more', 'Läs mer' ) ); ?>
								<svg class="vv-vak-chevron" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
							</button>
							<?php endif; ?>
							<button
								type="button"
								class="vakance-apply-btn vv-vak-btn vv-vak-btn--apply"
								data-position="<?php echo esc_attr( $vak->post_title ); ?>"
								data-post-id="<?php echo absint( $vak->ID ); ?>">
								<?php echo esc_html( vv_t( 'Pieteikties →', 'Apply →', 'Ansök →' ) ); ?>
							</button>
						</div>

						<?php if ( $has_details ) : ?>
						<div class="vv-vak-details" id="<?php echo esc_attr( $details_id ); ?>" hidden>
							<?php if ( $apraksts ) : ?>
							<section class="vv-vak-details__section">
								<h3><?php echo esc_html( vv_t( 'Par amatu', 'About the role', 'Om tjänsten' ) ); ?></h3>
								<?php echo wp_kses_post( $apraksts ); ?>
							</section>
							<?php endif; ?>

							<?php if ( $prasibas ) : ?>
							<section class="vv-vak-details__section">
								<h3><?php echo esc_html( vv_t( 'Prasības', 'Requirements', 'Krav' ) ); ?></h3>
								<?php echo wp_kses_post( $prasibas ); ?>
							</section>
							<?php endif; ?>

							<?php if ( $piedavajam ) : ?>
							<section class="vv-vak-details__section">
								<h3><?php echo esc_html( vv_t( 'Mēs piedāvājam', 'We offer', 'Vi erbjuder' ) ); ?></h3>
								<?php echo wp_kses_post( $piedavajam ); ?>
							</section>
							<?php endif; ?>

							<?php if ( $kontakts ) : ?>
							<div class="vv-vak-kontakts">
								<strong><?php echo esc_html( vv_t( 'Pieteikties vai jautāt:', 'Apply or enquire:', 'Ansök eller fråga:' ) ); ?></strong> <?php echo esc_html( $kontakts ); ?>
							</div>
							<?php endif; ?>
						</div>
						<?php endif; ?>

					</article>
					<?php endforeach; ?>
				</div>

			<?php else : ?>

				<div class="vv-vak-empty">
					<p><?php echo esc_html( vv_t( 'Šobrīd aktīvu vakanču nav.', 'There are currently no active vacancies.', 'Det finns för närvarande inga aktiva lediga tjänster.' ) ); ?></p>
					<p><?php echo esc_html( vv_t( 'Sekojiet mūsu jaunumiem vai sūtiet savu CV uz', 'Follow our news or send your CV to', 'Följ våra nyheter eller skicka ditt CV till' ) ); ?> <a href="mailto:info@vecvagari.com">info@vecvagari.com</a></p>
				</div>

			<?php endif; ?>

		</div>
	</section>

</main>

<!-- ── LRM-125: Application modal ── -->
<div id="apply-modal" class="apply-modal" role="dialog" aria-modal="true" aria-labelledby="apply-modal-title" hidden>
	<div class="apply-modal__overlay"></div>
	<div class="apply-modal__card">
		<button type="button" class="apply-modal__close" aria-label="<?php echo esc_attr( vv_t( 'Aizvērt', 'Close', 'Stäng' ) ); ?>">&times;</button>
		<h2 id="apply-modal-title" class="apply-modal__title">
			<?php echo esc_html( vv_t( 'Pieteikties:', 'Apply for:', 'Ansök om:' ) ); ?> <span id="apply-modal-position-label"></span>
		</h2>

		<div id="apply-modal-success" class="apply-modal__success" hidden>
			<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
			<h3><?php echo esc_html( vv_t( 'Paldies par pieteikumu!', 'Thank you! Your application has been submitted.', 'Tack! Din ansökan har skickats.' ) ); ?></h3>
			<p><?php echo esc_html( vv_t( 'Esam saņēmuši Jūsu pieteikumu un sazināsimies ar Jums tuvākajā laikā.', 'We have received your application and will be in touch shortly.', 'Vi har mottagit din ansökan och hör av oss inom kort.' ) ); ?></p>
		</div>

		<form id="apply-modal-form" class="apply-modal__form" enctype="multipart/form-data" novalidate>
			<input type="hidden" name="action" value="vakance_apply">
			<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'vakance_apply' ) ); ?>">
			<input type="hidden" name="position" id="apply-position" value="">
			<input type="hidden" name="post_id" id="apply-post-id" value="">

			<div class="apply-modal__field">
				<label for="apply-name"><?php echo esc_html( vv_t( 'Vārds, Uzvārds', 'Full name', 'Fullständigt namn' ) ); ?> <span aria-hidden="true">*</span></label>
				<input type="text" id="apply-name" name="applicant_name" required autocomplete="name" placeholder="<?php echo esc_attr( vv_t( 'Piem., Jānis Bērziņš', 'E.g. John Smith', 'T.ex. Erik Svensson' ) ); ?>">
			</div>

			<div class="apply-modal__field">
				<label for="apply-email"><?php echo esc_html( vv_t( 'E-pasts', 'Email', 'E-post' ) ); ?> <span aria-hidden="true">*</span></label>
				<input type="email" id="apply-email" name="applicant_email" required autocomplete="email" placeholder="<?php echo esc_attr( vv_t( 'jums@piemers.lv', 'you@example.com', 'du@exempel.se' ) ); ?>">
			</div>

			<div class="apply-modal__field">
				<label for="apply-phone"><?php echo esc_html( vv_t( 'Tālrunis', 'Phone', 'Telefon' ) ); ?> <span aria-hidden="true">*</span></label>
				<input type="tel" id="apply-phone" name="applicant_phone" required autocomplete="tel" placeholder="+371 2X XXX XXX">
			</div>

			<div class="apply-modal__field">
				<label for="apply-motivation"><?php echo esc_html( vv_t( 'Motivācijas vēstule', 'Cover letter', 'Personligt brev' ) ); ?></label>
				<textarea id="apply-motivation" name="motivation" rows="4" placeholder="<?php echo esc_attr( vv_t( 'Pastāstiet, kāpēc interesē šī vakance…', 'Tell us why you are interested in this role…', 'Berätta varför du är intresserad av denna tjänst…' ) ); ?>"></textarea>
			</div>

			<div class="apply-modal__field">
				<label for="apply-cv"><?php echo esc_html( vv_t( 'CV (fails)', 'CV (file)', 'CV (fil)' ) ); ?> <span aria-hidden="true">*</span></label>
				<input type="file" id="apply-cv" name="cv_file" required accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
				<p class="apply-modal__field-hint">PDF, DOC <?php echo esc_html( vv_t( 'vai', 'or', 'eller' ) ); ?> DOCX &middot; <?php echo esc_html( vv_t( 'maks.', 'max.', 'max.' ) ); ?> 5 MB</p>
			</div>

			<div class="apply-modal__field apply-modal__field--checkbox">
				<label>
					<input type="checkbox" name="gdpr_consent" value="1" required>
					<?php echo esc_html( vv_t( 'Piekrītu savu datu apstrādei atbilstoši', 'I consent to the processing of my data in accordance with the', 'Jag samtycker till behandlingen av mina uppgifter i enlighet med' ) ); ?>
					<a href="<?php echo esc_url( home_url( '/privatuma-politika/' ) ); ?>" target="_blank"><?php echo esc_html( vv_t( 'Privātuma politikai', 'Privacy Policy', 'integritetspolicyn' ) ); ?></a> <span aria-hidden="true">*</span>
				</label>
			</div>

			<div class="apply-modal__error" id="apply-modal-error" hidden></div>

			<button type="submit" class="apply-modal__submit">
				<?php echo esc_html( vv_t( 'Iesniegt pieteikumu', 'Submit application', 'Skicka ansökan' ) ); ?>
				<span class="apply-modal__spinner" hidden>
					<svg class="apply-modal__spin-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/><line x1="2" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="22" y2="12"/><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"/><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"/></svg>
				</span>
			</button>
		</form>
	</div>
</div>

<?php get_footer(); ?>
