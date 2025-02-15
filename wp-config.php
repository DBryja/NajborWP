<?php


/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
define( 'DB_NAME', 'u304003356_najbor' );
define( 'DB_USER', 'u304003356_admin' );
define( 'DB_PASSWORD', 'BTR#;poG/$c7' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

define('WP_HOME','https://najbor.pl/');
define('WP_SITEURL','https://najbor.pl/');

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
define( 'AUTH_KEY',         '5Ov0r#dpAsRq#:V:rAJB+~:5H`88! rp,J(#):/|mJ:==-krq^Q%d8Zwx_aC%Jbt' );
define( 'SECURE_AUTH_KEY',  '~7dJkg)]9:,JybORdG`iu&:>sYo9Rnzk)+qB qNo4%>ZrWZ*c4)=FB~{lO27ul__' );
define( 'LOGGED_IN_KEY',    'etfb?uv,>[^QT_r$~Ua:[m6Grg!/z8P.HRQ/>N?mE`g f4z:G3>)f@6MrlnA,mBd' );
define( 'NONCE_KEY',        'xUkJmcg{f!D8CTI(H(jPyJOwIeXA0Ps^%u:g6o:|Y{urdb3.%>3>Iv4b[/*d6V(4' );
define( 'AUTH_SALT',        'UWSHLgrLe+2_uwf{-_8!&zaUWX>^6=F;Fx/nCSibtV<ONNb=.g~{dGyq1rZa`mL*' );
define( 'SECURE_AUTH_SALT', 'i}~H~311RCF]0F3Q2hjdnZY[p<Ek?)yD+L#*yEO8,g+ZOw8brJ-`=3sC~4fM(*Tn' );
define( 'LOGGED_IN_SALT',   '{(a|P`<gK, jRHw|=EW)E1B&`idfVLY/4[Gs4Z&?SB+NPK0hZWynL2-|Y4[hEd.w' );
define( 'NONCE_SALT',       ';~PmPUH1&u#U(jH*O$^8f_26%Agc6<dO8gU7^&Z%E>WxG0QA?OnWj#8neKlR3=~D' );

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
