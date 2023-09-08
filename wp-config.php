<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'getenv('wordpress_DB_NAME')' );

/** Database username */
define( 'DB_USER', 'getenv('wordpress_DB_USER')' );

/** Database password */
define( 'DB_PASSWORD', 'getenv('wordpress_DB_PASSWORD')' );

/** Database hostname */
define( 'DB_HOST', 'getenv('wordpress_DB_HOST')' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'V:8230fn{5&ht~Yw|sVTYc!jCvf#}yGgP$<YeOYQs4]#AIBMSw=Ry na4rDPZ@;T' );
define( 'SECURE_AUTH_KEY',  'oRf`yy|.?PyjH1&D!h:T80fi[550u^26o@4Dacp,7s{3_2Ml]$#C7F4Q-F-B#mmf' );
define( 'LOGGED_IN_KEY',    ' ]m/oK]SHSQ7ZJpSe|39d;^>bRp^ALhp6$o3?/S,y8&t!i7t*Xz/h#SY2y=5#gF ' );
define( 'NONCE_KEY',        'J*{^85=N.RlL3eVrCZ0vz]`y12`[Bc*tgx@i70veC@4y`(Wx$zO}{cqT`wKXnP0u' );
define( 'AUTH_SALT',        'tRh!+i*d#By/m1.D30$;Q|Nh 0@s`x6}J_)vuM7lhfEdszgR+j7P>M2]NW7|bk7Q' );
define( 'SECURE_AUTH_SALT', '!e}6KrUU/ym1X85`1!ufmclb0:gUQ+O*myg+&b-(]-Hn+3/[51es*N*b5cTmU|*q' );
define( 'LOGGED_IN_SALT',   '/;IsYyCH`&<(sd86x~}f~4;[#zA!YkTgKs|QWM[RDm$I2I@5bziOxOzw!YIF [u$' );
define( 'NONCE_SALT',       '(DYbRk&2JD020z3o8n> ]8Kn>DW#u>CIl07{r~!NYOD|$diWX/vBhHx+m5B)B/C5' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
