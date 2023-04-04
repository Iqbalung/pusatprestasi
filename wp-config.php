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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp2' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'E^oSruHmX(3:n;PnuNlaZ&;iLyc6I]:Lih`H;6^vm8D(fZT9jUi-~]~i6 ,?jaCh' );
define( 'SECURE_AUTH_KEY',  '8mEghm=x/^%1o!n01Cq%?I:(g^2!+vJ/5%lbbf)}]MtPW[M_ZoL=PXrtv/H&s< D' );
define( 'LOGGED_IN_KEY',    '0N}o*RUT*@lWdn6:O2LRrsBysC:cL+hWlZmH=PnPb_RfB8t^`j6i8cA0g#;,pl]<' );
define( 'NONCE_KEY',        '6*L*v21Nz}x+YVV2ay)fN*MWob31`m7{ipSkPMGBG),AO22Ww?nUGnw5/=9PFub}' );
define( 'AUTH_SALT',        'I&g/L?)3?8rQ*)x.|Pxe#7X%^4W~q4>4WFf7lGg_&` M6Z>UnZ?i+G>HR4P5^iiY' );
define( 'SECURE_AUTH_SALT', 'KGEy?z,X#e/euCrj&Z=?nlZ V/{Xn#g|l-_Q_?JGKuy:NEm**?^N];RW?34;?d%@' );
define( 'LOGGED_IN_SALT',   '[+V%]IP_}]~c^f%w!HVTiIpYG7^J]+8T.mt<fE^GX=ct>on-#azc;mnI7pu<KO5:' );
define( 'NONCE_SALT',       'aNGl/MyLR(zUrj9/c)FR/lSd4Df6mfc/r$)/gKdcAE5G}uVQT@bJqu])%M,ba_NP' );

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
