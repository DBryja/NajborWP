<?php
$envPath = dirname(__DIR__) . '/.env';
$envContent = file_get_contents($envPath);
$lines = explode("\n", trim($envContent)); // Rozdzielanie po nowej linii
$env = [];
foreach ($lines as $line) {
    if (strpos($line, '=') !== false) {
        list($key, $value) = explode('=', $line, 2);
        $env[trim($key)] = trim($value, "\" \t\n\r\0\x0B");
    }
}
define("MULTI_LANG", strtolower($env["MULTI_LANG"]) === 'true');
define('DB_NAME', $env['DB_NAME']);
define('DB_USER', $env['DB_USER']);
define('DB_PASSWORD', $env['DB_PASSWORD']);
define('DB_HOST', $env['DB_HOST']);
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

define('WP_HOME',$env['WP_HOME']);
define('WP_SITEURL',$env['WP_SITEURL']);

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', $env['AUTH_KEY']);
define('SECURE_AUTH_KEY', $env['SECURE_AUTH_KEY']);
define('LOGGED_IN_KEY', $env['LOGGED_IN_KEY']);
define('NONCE_KEY', $env['NONCE_KEY']);
define('AUTH_SALT', $env['AUTH_SALT']);
define('SECURE_AUTH_SALT', $env['SECURE_AUTH_SALT']);
define('LOGGED_IN_SALT', $env['LOGGED_IN_SALT']);
define('NONCE_SALT', $env['NONCE_SALT']);
/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'WP_AUTO_UPDATE_CORE', true );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
