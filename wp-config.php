<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'umlib-wp');

/** MySQL database username */
define('DB_USER', 'umlib-wp');

/** MySQL database password */
define('DB_PASSWORD', 'umlib-wp');

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
define('AUTH_KEY',         'k$2]$9H|-wRXwR>5(bD;~S^YVI~?MA?GhZ4K)U__+;//Eor~C*Pwwqu:+*q:q[cb');
define('SECURE_AUTH_KEY',  'k4c+!Q03wWdzd8<~d{NMyzI:}`Y7k^6[<l<2y$:lMb:+-Yy.59&!+q>P}KnzG4JV');
define('LOGGED_IN_KEY',    'l!F,!{-CnFQ)B&yMkNglHm+b<xIJ>#+X3;f`A#Iwh(q4tSeTO9<=7R)u$1Y;LOWG');
define('NONCE_KEY',        'G,odN{yl]G,(nM_d^kg-~2RnQpCC(-CH2cy^ur<t3L;{%S$7*%=QamEHT<R;V+Tm');
define('AUTH_SALT',        's1SWbt+EZezZ}>b#}_+dKWPKi8O_TZZF5P0(cQHb7}^Jodq/)~RTE.Y@6rV4{;5H');
define('SECURE_AUTH_SALT', 'LK=HwUh7S|X={4J0O$rIu@|_nKcF8sjJi>+2NG}O|FzvT0eH/|S6CKgIPu0dkk3d');
define('LOGGED_IN_SALT',   's^xk1r$@=V{p[ -V1UrY-628uPpD|YAE(@Rv;2<Bii%dAP0)jWNrA.n6%euW,MEe');
define('NONCE_SALT',       'n.$RvG#Q;.0y6/nHx(9 b6J.#>.rE{+~&0pFNWqzwPfo+|3+o/NoC&[mlT`K~K!J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_umlib_';

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
