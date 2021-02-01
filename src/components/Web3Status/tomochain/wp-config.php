<?php
define( 'WP_CACHE', true ); // Added by WP Rocket

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
define( 'DB_NAME', 'tomochain' );

/** MySQL database username */
define( 'DB_USER', 'tb' );

/** MySQL database password */
define( 'DB_PASSWORD', 'tb123!@#' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'l00+*ALbyPSA(7HTb=,=R( [7(.7FIY7BisH<J(YM|Y!-5a*CN?`~!-^NZv;/H)Y' );
define( 'SECURE_AUTH_KEY',  '|?c2^hr:269lv5XS~5t/x/ibS`?h-!i|o R12d35Lh,u=n&D-.S^~pVH3y7k+Iv+' );
define( 'LOGGED_IN_KEY',    'xr`df~`bv,3)t+D:E9XC9QTU%}EM}%fb|0T^Bq5/<NlN3vrGKT8g|Dwi6qh.Zlyh' );
define( 'NONCE_KEY',        'se,YM~&uhWta$q=BA0xw2e/:hGlD5o6|#*))gZM+K6~r{a5GAzIC!DFJ=6gKLf2q' );
define( 'AUTH_SALT',        'jT=bF<JI{Vq+]-u*_JP#F{-}9> .vn=wh<2&{1HFy20>l*aY4t:; [05`xow7oOi' );
define( 'SECURE_AUTH_SALT', 'SB}(}41,a}fmpdSH/<%K2^x{<Z]Q($q[GewAd MD<0F>TDJvX~9u@z0!c-e;EzX ' );
define( 'LOGGED_IN_SALT',   'I(`dR=}3^hqqEQ&hm#k*Oty:U|KuyT#D@%I)t#]*B 3K-uY>@+Ofnf!Wm}p>)X(E' );
define( 'NONCE_SALT',       'T(En,1C>(:ElEzl}r5-uM*`LKiM*-+k.r|IZ12pZCgqPJq@*{F/^ &=q*l*G14`_' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
