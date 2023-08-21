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
define( 'DB_NAME', 'wp-test' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'ntf12345' );

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
define( 'AUTH_KEY',         '8XG9y2MRmYGXlFeM#4[py9A726Ijh]9GGS6gHw3Bt:WZr7h<,k-M+5>x(9rQ>O&6' );
define( 'SECURE_AUTH_KEY',  'h`e]drvU%6GHI-KBPt[me}ZC[zPa.,4:L[r0ccSd6h6amg.Yun[s[VBjG@<!R%0(' );
define( 'LOGGED_IN_KEY',    'p3y)%N!l6Z(&/LOJWe++B?w^Vsw`<(L+,e|HZ()U{h3J-9Z~DK)_^{3R_SM 3L0w' );
define( 'NONCE_KEY',        'ZPLIX FzS{3,XfNWHo9T5r4#c9=g*,Kw_fTU$+GYT(z]@zMal{I.%(O)jH;=caAq' );
define( 'AUTH_SALT',        'vv?z7VG!hf,1O6vY{7<rKZbo.!ztMNs=WY)9cJ)A1r*RjH^8Xn#QGg>Kp$mICf+F' );
define( 'SECURE_AUTH_SALT', 'mqIL*Dw-45~,av`y;boibd*y}:<eAGt#(Y1n977knW!`NPKKm99QcFxf4t0Mh4%=' );
define( 'LOGGED_IN_SALT',   'C3(T?W~RCJ#=Oh9Tv|g+)6qH5jek|}LUR4mp85/p9*GIH]:_&w~C[d6^96/[!D8Y' );
define( 'NONCE_SALT',       'e~4MZ-W0UJ:|zjO<6DfQz]=J-=m;~ND/GTB|d`DHpJE/lJ>6LDQvzy[7yG0sdkCo' );

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
define('FS_METHOD', 'direct');



/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
define(‘WPLANG’,’hi_IN’);