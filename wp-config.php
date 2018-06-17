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
define('DB_NAME', 'localsite');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'mypassword');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'I)%-%?p>T&3uL9_K5hq6>PguOQHT(|1.^cG/h=%$-1wcSo9r4z&hAjw5Yj45P$~f');
define('SECURE_AUTH_KEY',  '|qJr_q`lNsX/VJKaULmzOg&[3C[kAQM,;<aE_(&dk)Pa~#Z>.oq^k6LM[j<=Iiqd');
define('LOGGED_IN_KEY',    'kWi@Jf(ZCI=L4uI=;Y7JfC|&NeM!b[Gd9tal5()aCUVAD=v!E4!d[x#b&AVI/a+>');
define('NONCE_KEY',        '7oz-l[PRK%OxfrDlX;HI/]2sIHLul[Hf{pR7+s}^DlJ,`yl~`tA#y9T3td!L f([');
define('AUTH_SALT',        'Z2WAj`MeL91/W^HqS57G)Fl*UBT#lnr*1|*MQ{S;vnv7~QkNB=(DnR?1u~|`6)fj');
define('SECURE_AUTH_SALT', 'HWkH@.-Z}e&:UU`wCec32iQv5eppGcy_`t-^.M!TZ-{jXkF?J_wNN{WiaAA?@7Ba');
define('LOGGED_IN_SALT',   '}cSNUpOaX}U*q-H_+sT#]O:hg`@MGnt=L&`b Lu==oJc,j8>oHKZ&U/C=ajpJ}Xx');
define('NONCE_SALT',       '>6$K*l/ ]r;Hjde/8^eD?p.:Y%hEIyS8o{/E>+23=ghuld1:<^WiH#in7_r5!baB');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
