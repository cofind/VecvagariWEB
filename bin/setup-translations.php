<?php
/**
 * LRM-128/LRM-129: Create EN + SV translated pages for all content pages.
 * LRM-129: Updated to use language-specific slugs (en_slug, sv_slug) instead
 * of the LV slug for all EN/SV pages. This eliminates WordPress slug collisions
 * which caused Polylang to always serve the lower-ID (LV) page.
 *
 * Run once on the server (idempotent — skips pages that already exist):
 *   wp eval-file bin/setup-translations.php --allow-root
 *
 * After running, flush permalinks:
 *   wp rewrite flush --allow-root
 *
 * @package VecvagariTheme
 */

if ( ! function_exists( 'pll_set_post_language' ) ) {
	WP_CLI::error( 'Polylang is not active. Activate it first.' );
	return;
}

// ── Page definitions ─────────────────────────────────────────────────────────
// lv_slug: LV page slug to look up, or null for the static front page.
// en_title / sv_title: page titles for each translation.

// LRM-129: Each page now has explicit en_slug / sv_slug so translated pages
// use language-specific URL slugs, avoiding WordPress slug collisions.
$pages = [
	[ 'lv_slug' => null,                            'en_slug' => 'home-en',                    'sv_slug' => 'hem',                          'en_title' => 'Vecvagari M – Forestry in Kurzeme and Zemgale',   'sv_title' => 'Vecvagari M – Skogsbruk i Kurzeme och Zemgale'  ],
	[ 'lv_slug' => 'par-mums',                      'en_slug' => 'about-us',                   'sv_slug' => 'om-oss',                       'en_title' => 'About us',                                        'sv_title' => 'Om oss'                                          ],
	[ 'lv_slug' => 'meza-ipasumu-pirksana',         'en_slug' => 'forest-property-purchase',   'sv_slug' => 'kop-av-skogsfastigheter',      'en_title' => 'Forest property purchase',                        'sv_title' => 'Köp av skogsfastigheter'                         ],
	[ 'lv_slug' => 'cirsmu-un-sortimentu-pirksana', 'en_slug' => 'felling-sites-purchase',     'sv_slug' => 'kop-av-avverkningsplatser',    'en_title' => 'Purchase of felling sites and assortments',       'sv_title' => 'Köp av avverkningsplatser och sortiment'         ],
	[ 'lv_slug' => 'mezizstrades-pakalpojumi',      'en_slug' => 'forestry-services',          'sv_slug' => 'skogstjanster',                'en_title' => 'Forestry services',                               'sv_title' => 'Skogstjänster'                                   ],
	[ 'lv_slug' => 'vakances',                      'en_slug' => 'vacancies',                  'sv_slug' => 'lediga-tjanster',              'en_title' => 'Vacancies',                                       'sv_title' => 'Lediga tjänster'                                 ],
	[ 'lv_slug' => 'kontakti',                      'en_slug' => 'contact',                    'sv_slug' => 'kontakt',                      'en_title' => 'Contact',                                         'sv_title' => 'Kontakt'                                         ],
	[ 'lv_slug' => 'pieteikuma-forma',              'en_slug' => 'application-form',           'sv_slug' => 'ansokan',                      'en_title' => 'Application form',                                'sv_title' => 'Ansökningsformulär'                              ],
];

// ── Helpers ───────────────────────────────────────────────────────────────────

/**
 * Find the LV page post object by its slug.
 * Passes the 'lang' Polylang query arg to avoid returning EN/SV pages
 * that share the same slug.  Falls back to manual language check if
 * the Polylang arg returns nothing (e.g. lang param not yet hooked).
 *
 * Pass null to resolve the static front page.
 */
function lrm128_lv_page( ?string $slug ): ?WP_Post {
	if ( $slug === null ) {
		$id = (int) get_option( 'page_on_front' );
		return $id ? get_post( $id ) : null;
	}

	// Try with Polylang's language filter first.
	$found = get_posts( [
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'name'           => $slug,
		'posts_per_page' => -1,
		'lang'           => 'lv',
	] );

	if ( empty( $found ) ) {
		// Fallback: fetch all pages with this slug and filter manually.
		$all = get_posts( [
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'name'           => $slug,
			'posts_per_page' => 10,
		] );
		$found = array_values( array_filter( $all, function( $p ) {
			if ( ! function_exists( 'pll_get_post_language' ) ) {
				return true; // Polylang not active — accept first match.
			}
			$lang = pll_get_post_language( $p->ID );
			return $lang === 'lv' || $lang === false;
		} ) );
	}

	return $found[0] ?? null;
}

/**
 * Create a translated page for $lv_id in $lang, unless it already exists.
 * Links the new page to its LV source and all existing sibling translations
 * via pll_save_post_translations().
 *
 * Uses a temporary slug during wp_insert_post to avoid WP's uniqueness check
 * (WP doesn't know about Polylang language prefixes), then forces the correct
 * slug via $wpdb->update() after the language is set.
 *
 * Returns the post ID (new or existing), or 0 on failure.
 */
// LRM-129: $target_slug is the language-specific slug (e.g. 'about-us' for EN).
function lrm128_ensure_translation( int $lv_id, string $lang, string $title, string $target_slug ): int {
	$existing = pll_get_post( $lv_id, $lang );
	if ( $existing ) {
		WP_CLI::log( "    [{$lang}] already exists (ID {$existing}) — skipping creation." );
		return $existing;
	}

	// Use a temp slug to avoid WP's unique-slug check renaming our page.
	$temp_slug = $target_slug . '-tmp';

	$new_id = wp_insert_post( [
		'post_type'    => 'page',
		'post_title'   => $title,
		'post_name'    => $temp_slug,
		'post_status'  => 'publish',
		'post_content' => '',
	], true );

	if ( is_wp_error( $new_id ) ) {
		WP_CLI::warning( "    [{$lang}] Failed to create '{$title}': " . $new_id->get_error_message() );
		return 0;
	}

	// Set language so Polylang manages this page in the correct language context.
	pll_set_post_language( $new_id, $lang );

	// Link this translation to the LV source (preserving any existing siblings).
	$translations          = pll_get_post_translations( $lv_id );
	$translations['lv']    = $lv_id;
	$translations[ $lang ] = $new_id;
	pll_save_post_translations( $translations );

	// Force the language-specific slug now that the language is set.
	lrm128_force_slug( $new_id, $target_slug );

	$actual_slug = get_post_field( 'post_name', $new_id );
	WP_CLI::success( "    [{$lang}] Created '{$title}' — ID {$new_id}, slug: {$actual_slug}" );
	return $new_id;
}

/**
 * Force a post_name value, bypassing WordPress's unique-slug check.
 * Safe to use in WP-CLI scripts where we intentionally want same slugs
 * across Polylang language-prefix URLs.
 */
function lrm128_force_slug( int $post_id, string $slug ): void {
	global $wpdb;
	$wpdb->update(
		$wpdb->posts,
		[ 'post_name' => $slug ],
		[ 'ID' => $post_id ],
		[ '%s' ],
		[ '%d' ]
	);
	clean_post_cache( $post_id );
}

// ── Main — create missing translations ────────────────────────────────────────

WP_CLI::log( "\n=== Creating missing EN + SV translations ===" );

foreach ( $pages as $def ) {
	$lv_post = lrm128_lv_page( $def['lv_slug'] );

	if ( ! $lv_post ) {
		$label = $def['lv_slug'] ?? '(front page)';
		WP_CLI::warning( "  LV page not found for '{$label}' — skipping." );
		continue;
	}

	$lv_id = $lv_post->ID;
	$slug  = $lv_post->post_name;
	$label = $def['lv_slug'] === null ? "(front page, slug: {$slug})" : $slug;

	WP_CLI::log( "\n{$label}  [LV ID: {$lv_id}]" );

	lrm128_ensure_translation( $lv_id, 'en', $def['en_title'], $def['en_slug'] );
	lrm128_ensure_translation( $lv_id, 'sv', $def['sv_title'], $def['sv_slug'] );
}

// ── Fix slugs — enforce correct language-specific slugs on every deploy ──────
// LRM-129: EN/SV pages now use their own slugs (about-us, om-oss, etc.)
// rather than the LV slug. This section enforces them idempotently.

WP_CLI::log( "\n=== Fixing slugs for existing translations ===" );

foreach ( $pages as $def ) {
	$lv_post = lrm128_lv_page( $def['lv_slug'] );
	if ( ! $lv_post ) {
		continue;
	}

	$lv_id = $lv_post->ID;

	$targets = [ 'en' => $def['en_slug'], 'sv' => $def['sv_slug'] ];
	foreach ( $targets as $lang => $target_slug ) {
		$trans_id = pll_get_post( $lv_id, $lang );
		if ( ! $trans_id ) {
			continue;
		}

		$current_slug = get_post_field( 'post_name', $trans_id );
		if ( $current_slug === $target_slug ) {
			WP_CLI::log( "  [{$lang}] ID {$trans_id} slug OK: {$current_slug}" );
			continue;
		}

		lrm128_force_slug( $trans_id, $target_slug );
		WP_CLI::success( "  [{$lang}] ID {$trans_id}: slug fixed '{$current_slug}' → '{$target_slug}'" );
	}
}

WP_CLI::log( '' );
WP_CLI::success( 'All done. Run:  wp rewrite flush --allow-root' );
