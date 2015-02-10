<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// Include local configuration
if (file_exists(dirname(__FILE__) . '/llocal-config.php')) {//Added here
	include(dirname(__FILE__) . '/local-config.php');
}

// Global DB config
if (!defined('DB_NAME')) {
	define('DB_NAME', 'db_rhcbc');
}
if (!defined('DB_USER')) {
	define('DB_USER', 'admin');
}
if (!defined('DB_PASSWORD')) {
	define('DB_PASSWORD', 'admin');
}
if (!defined('DB_HOST')) {
	define('DB_HOST', 'localhost');
}

/** Database Charset to use in creating database tables. */
if (!defined('DB_CHARSET')) {
	define('DB_CHARSET', 'utf8');
}

/** The Database Collate type. Don't change this if in doubt. */
if (!defined('DB_COLLATE')) {
	define('DB_COLLATE', '');
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Hem^+G/.sy8[8HT|&ej%>^wny:mr|pxHvqR5SC0|SZ`v~B*^xg}yz8zN!,nmm<K?');
define('SECURE_AUTH_KEY',  'p{ah^h61VT#RIU-FAuXDu]?kQ:;/sDrr]uK`*7l&Sh7depjqZiiuWCLD76;`|Zmt');
define('LOGGED_IN_KEY',    'i0cg+@GbVACbz%L7plq2f56&2Iu{W`6#mMG+l1f9./PCp~g%QW`Y-QFi.>>./0Z3');
define('NONCE_KEY',        '3n3qc4M:*M|]CAgK[9`@98uiq5IZ:hFCDGNeQaubY/+;hw._.$L(%+]*<B/8?m|(');
define('AUTH_SALT',        'yh8NcgIY2^{[%?-fV0GrIwq0Qk<V6Rr03AXs:@EH05G-W~W84{0|V~}Y9VP})fk$');
define('SECURE_AUTH_SALT', '?.8aB;s@7xvjm!$rE%+jmI)G+oY+G}h0}X3dk=Fp!y5M,iGe^7)c.z]-L3,|spP1');
define('LOGGED_IN_SALT',   'ah6oHqWtadf_7w8[q@y:di5ieq..tJ%,@kk[5t0K9qIiN0A]ZktKhIG%n+~pDQjw');
define('NONCE_SALT',       '&*8;9;|b2-RjUo-#EWt?4?n[Il*o*X;O9Z5yeJ+O,t-(=o+2&[|b8;Bh&%~:;GZI');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if (!defined('WP_DEBUG')) {
	define('WP_DEBUG', false);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
