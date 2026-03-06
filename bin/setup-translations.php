<?php
/**
 * LRM-128: Create EN + SV translated pages for all content pages.
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

$pages = [
	[ 'lv_slug' => null,                               'en_title' => 'Vecvagari M – Forestry in Kurzeme and Zemgale',   'sv_title' => 'Vecvagari M – Skogsbruk i Kurzeme och Zemgale'  ],
	[ 'lv_slug' => 'par-mums',                         'en_title' => 'About us',                                        'sv_title' => 'Om oss'                                          ],
	[ 'lv_slug' => 'meza-ipasumu-pirksana',            'en_title' => 'Forest property purchase',                        'sv_title' => 'Köp av skogsfastigheter'                         ],
	[ 'lv_slug' => 'cirsmu-un-sortimentu-pirksana',    'en_title' => 'Purchase of felling sites and assortments',       'sv_title' => 'Köp av avverkningsplatser och sortiment'         ],
	[ 'lv_slug' => 'mezizstrades-pakalpojumi',         'en_title' => 'Forestry services',                               'sv_title' => 'Skogstjänster'                                   ],
	[ 'lv_slug' => 'vakances',                         'en_title' => 'Vacancies',                                       'sv_title' => 'Lediga tjänster'                                 ],
	[ 'lv_slug' => 'kontakti',                         'en_title' => 'Contact',                                         'sv_title' => 'Kontakt'                                         ],
	[ 'lv_slug' => 'pieteikuma-forma',                 'en_title' => 'Application form',                                'sv_title' => 'Ansökningsformulär'                              ],
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
 * Returns the post ID (new or existing), or 0 on failure.
 */
function lrm128_ensure_translation( int $lv_id, string $lang, string $title, string $slug ): int {
	$existing = pll_get_post( $lv_id, $lang );
	if ( $existing ) {
		WP_CLI::log( "    [{$lang}] already exists (ID {$existing}) — skipping." );
		return $existing;
	}

	$new_id = wp_insert_post( [
		'post_type'    => 'page',
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_content' => '',
	], true );

	if ( is_wp_error( $new_id ) ) {
		WP_CLI::warning( "    [{$lang}] Failed to create '{$title}': " . $new_id->get_error_message() );
		return 0;
	}

	// Set language so Polylang can manage the slug correctly.
	pll_set_post_language( $new_id, $lang );

	// Link this translation to the LV source (preserving any existing siblings).
	$translations          = pll_get_post_translations( $lv_id );
	$translations['lv']    = $lv_id;
	$translations[ $lang ] = $new_id;
	pll_save_post_translations( $translations );

	$actual_slug = get_post_field( 'post_name', $new_id );
	WP_CLI::success( "    [{$lang}] Created '{$title}' — ID {$new_id}, slug: {$actual_slug}" );
	return $new_id;
}

// ── Main ──────────────────────────────────────────────────────────────────────

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

	lrm128_ensure_translation( $lv_id, 'en', $def['en_title'], $slug );
	lrm128_ensure_translation( $lv_id, 'sv', $def['sv_title'], $slug );
}

WP_CLI::log( '' );
WP_CLI::success( 'All done. Run:  wp rewrite flush --allow-root' );
