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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hotels2');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'data098098D');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'DD>y8Uv]<Iw20NXG^^j3o.}naTaO1mRfA+:p*qLHqXXOZFFelf+56sjd9iVy#5<S');
define('SECURE_AUTH_KEY',  'BArZ=OTaxc}_P:RX?=iB_g3(J7YeSL^G6@/2LHJnICv4[`3LGl*eubQwm#MTJ^l1');
define('LOGGED_IN_KEY',    '1qOtCxl[ T|@ltb,Bu3=ci)Ex,F*3Em#t}mj7cPREWcrZQa1De6tupp.Ewk1; 8&');
define('NONCE_KEY',        'v{zf1N/0lIP2PX5O,D}1CGtE*yQzTA*z}&Ucm)H20^DZbuog4|Qw>mr~GK41++^A');
define('AUTH_SALT',        '0>GTlZH]U^@v9(8Gf5D6D5#g]vVK16cpt:a9Y38Wtp1H0fW{WM0q569:l(t4C={O');
define('SECURE_AUTH_SALT', '2!`~me0/|0M;0<gh4MBXD q}69.Z[ZI}&03]L 0_V4J@HY>GDzZ;yT@SL5H@`Vc`');
define('LOGGED_IN_SALT',   'Y[Wh`cJo3Ns/ebUMntIb>=mJi1V>Gbf+:Q<L`,/K+y 3.b{_[Xd8f-G*/b>[WDC2');
define('NONCE_SALT',       '[RHEE1dG,/Vn(*7<:HLS3JIR!Box!iB/.kSUorSlc.d.e}?4w,0tDqn_h=zs~yO+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
