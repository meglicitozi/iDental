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
define( 'DB_NAME', 'idental' );

/** MySQL database username */
define( 'DB_USER', 'idental' );

/** MySQL database password */
define( 'DB_PASSWORD', 'idental' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'ofMV!si:*0wHc-jX(;}a?/@J@T} (S}.Dp5[V(`l,1uGL]27*o=kk1]Xwu]aa-@1' );
define( 'SECURE_AUTH_KEY',  '.A7H.z7|(nGDbHblIW=BP[ddheTosDxbfIXYN,rIQ{^f70^pMn<s)Pdg4HKhgix|' );
define( 'LOGGED_IN_KEY',    '&bj<&Rs/uw6JFh5a^QNV6*;:.4DK!IfH%s73nsHG*guFgkj|(g$ZKwN%1haJ7%oM' );
define( 'NONCE_KEY',        'cE{MKmqeuNTt&w1$Xq@-4F[n57PN |Xjp4{tX+Fhnx&-fhFRY%/6!IVhq[Kf%(E7' );
define( 'AUTH_SALT',        'C~up2@cw6j?V=M&HJ-n7*,XZ|LOVDU_u.86@fS6Sb?qFu*N*3oI=?,*):AhXA/|B' );
define( 'SECURE_AUTH_SALT', '`N#Oy6jt}M TDl5_s+AX r]8#pmHldm:m`ef1:3/Pj.(,_Pi@xpx! /GguA!-wNq' );
define( 'LOGGED_IN_SALT',   'I0bj]-_D!}_~:T5TS$Qj8hV)6z5. ln?Y?*Qo=5<rp _&KpR-Z|P:(e#-k>?>+3X' );
define( 'NONCE_SALT',       'c=l7BOFEG{FJX(]vvx91^f^u.d1WeyIRkpMOV?ajuglxYZlRXiQpw=v1kkGX<+ g' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
