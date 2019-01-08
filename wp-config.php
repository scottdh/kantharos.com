<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sdhgator_kantharoscom');

/** MySQL database username */
define('DB_USER', 'sdhgator_Lida');

/** MySQL database password */
define('DB_PASSWORD', 'Q]P$,)ri,dns~yp.#X');

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
 define('AUTH_KEY',         'J)6oTRe,JC;avb_8O}KeJw,8zZ|sC=s%h5T6vk*J+t-]3|B}Dl7nSJeUR=li9d^2');
 define('SECURE_AUTH_KEY',  'GAC($JJ -kMz7/=m?+%-Mknf-Hl+%l91|#wUD ?e-LoyWn:iShv$a-TcH&-*<U5A');
 define('LOGGED_IN_KEY',    'xzZw 3M1e7m36t!iEfuT9s2aA1i?UbF+cU#yM8Ns}5+3/WowiK-:$?WE-F+06<XX');
 define('NONCE_KEY',        '}V(B^H|IWVYIc{qYs=T43TT)GsYo`cT#3TzIy|sv>d+u.W+i2O,nlnq6b}BT>CZI');
 define('AUTH_SALT',        'a$|2d%G-&{7:|Rh+dZ5&_Ajv-qqu-b-lr |_$|u2C7rXa;Ie@oy_8=H+LVx]|y,P');
 define('SECURE_AUTH_SALT', 'Y,MmOk#ap)LZ+boS$^tuwqO4c$bt5dNvvD+HT[LJ@y>e%boYquIWU:F;r%IEaU|D');
 define('LOGGED_IN_SALT',   '5v&`Po^ :_PH<Ou+@KG9>2CdoAJSn^zN54[meax_mAp^)-}Qz,~AORu`mA79gJ<h');
 define('NONCE_SALT',       'EyTtrg+B>PX^0s|cOmc*;){U(-D=-7glc:XMJVqn)5}~n02p*}e6v+|Lg`rSV2++');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
