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
define('DB_NAME', 'kcklaw_database');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'w+3OI|NfD#d.xfB1f=dl0n`E~{3Y)Y#3tK66y<]kkTp]/I3g:Y&YIk/`[P5W_$Fm');
define('SECURE_AUTH_KEY',  '}r684e[X2{2zE)g2Z(ymF:_Zan/GgflL<OzfD]TdGi|}).CVKfl(YRz!rNfBuweu');
define('LOGGED_IN_KEY',    'SwlAmG@)M1W4;ZT!D.G2w-rzfo6j:utu<ijwd)7q=pcgj^~]ZKtBG++y<N0CH)K[');
define('NONCE_KEY',        ':W[p@I{Vh|-SM$)N=`fu*39-N:Lf>tdove%&jkF3ZrsqDX5$V~ag{ru%FTaaN<@L');
define('AUTH_SALT',        ';ZS]?y!WnA ]g$3%51^)/#7BF~%JmP]jp_p*9xyqM1<T-!=DQgxazYX.K;u;HW[O');
define('SECURE_AUTH_SALT', '2(_?(%qE2e&>@-+6m5/HO;9G9V/2?7t|PBbV<w5FJh5|YG1V3e{H(^lu$DP&NIrM');
define('LOGGED_IN_SALT',   '.F(;KR%cw0PsB)z,!9g-VaVE`[gO,*~S)~F)BTk3U({5OE5TDugBa>;ydX97}sz@');
define('NONCE_SALT',       '0*%1?_+>>,^6sCy!^qZRXir(FQ+;:w^1W4m&]BCe(!%lz|}+3LExl&of[#R-_swj');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'hdint_';

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
