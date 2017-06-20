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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '_finanzas' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-Yfy}%/U>}-0_OskeZ%Vj~8sreNf5fA#F:T&76X<1#a6G~2UTg]|a<yQK83UuDOM');
define('SECURE_AUTH_KEY',  'M]z1:K{y`:<9[s@@XODlx2a!A~2[JKV4jY+XN>a@AX7|S}cFrVE,A=qu{~*l~KN-');
define('LOGGED_IN_KEY',    '6ly@.P]GF0f_DZ<sO1s0_|~nVlOwa$}-KMaV%&u+|p;+>84dj|=_t?22&f-sQ$_A');
define('NONCE_KEY',        '<#&_R26{pb0yIRw7Wmz(`aZ<U}[AUCu%qbh* $_Z78GsD[/<KX0K0F:+.|BVwvA=');
define('AUTH_SALT',        '-[LXB6Jz0 KI>=|&2#+b~V3u!`G)i#2RRA}$bKKY%$_*p2Rt*:[.wSGv|w)`F;6=');
define('SECURE_AUTH_SALT', '8mfz=JHf{b|/y5YnEK~-Jp0JKcxQ`_2Z@qY$R,Mo)]WXzu-|*^Rni6xpwxj7h-fM');
define('LOGGED_IN_SALT',   '>_S?oINj|ejgDkg,EnZ`eq<4P.g^1IVUw4+lWqvb/v8GRAq;g;`5s#[1U,x&]6FG');
define('NONCE_SALT',       '{e.7d,Qa%,;tdw6Po}Gf)G5kA*0yc<`PB;.MF+9-|b/0F^f-n_ZRzE4+tKSZ#mt7');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
