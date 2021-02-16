<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hujint_db');

/** MySQL database username */
define( 'DB_USER', 'hujint_db');

/** MySQL database password */
define( 'DB_PASSWORD', 'tphNWFV=LZ5yes~uARXNT');

/** MySQL hostname */
define( 'DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '99b34d367dcac3ce09d1e40e343881f73a2a6edc');
define( 'SECURE_AUTH_KEY',  '7d99d243f4abee9cd7b621cf114f95e926f636f9');
define( 'LOGGED_IN_KEY',    'e1686494efe25607b2bf0dc953cdc6b4b87b6dc2');
define( 'NONCE_KEY',        '93c57d44f2965c070a5db42a8f9a5ab0188127ef');
define( 'AUTH_SALT',        '05571536ad032ba75523868497e176abe5e255ac');
define( 'SECURE_AUTH_SALT', 'cb956af4c362bd4a5a23f333df3f1afa0cc23d38');
define( 'LOGGED_IN_SALT',   '5a40af1e6a27a1dffcdc54b71fae8038905c84b1');
define( 'NONCE_SALT',       'a6b31df6384ea53af1694bd04f00cb88c074fa8f');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
