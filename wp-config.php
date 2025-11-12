<?php
define( 'WP_CACHE', false ); // Added by WP Rocket
// Disallow file editing from WordPress admin
define('DISALLOW_FILE_EDIT', false);

 // Added by WP Rocket

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hanhweb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '123456' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'udx3hz79awv69wslpd9n9d3iiqzez57zygz0z0bmkj3yjhb93eh6kiik5wesheav' );
define( 'SECURE_AUTH_KEY',  'hk37kntx6ilffbnn2w58gomqlxoeo15a50yehn2ia0ijgq7afcssg0c6sw7yapwi' );
define( 'LOGGED_IN_KEY',    'odughdrurztu6ky0bqpi7bxi9tdwpkr2bjg2geuyxp0fyotsruusy8cz1jhg39f0' );
define( 'NONCE_KEY',        'd1wswnge5x3nme4as3krfbufv1bmeefawqgw0kna0pawbeyfwvclqyobwtvm6ezw' );
define( 'AUTH_SALT',        'jgep7o6ravs84wrjxue9wbtfxsy2sgihcua7qygjrxyziptuufgixtznkodkqzyj' );
define( 'SECURE_AUTH_SALT', 'adlrzakxukjepnu2tohl1gi77onklfer1ain1h94hmcvz6npedrbkgaa84yekp2d' );
define( 'LOGGED_IN_SALT',   'c6iywnckidvnech5t9d2fjlpcuzsfn0cttnh1s1gleydbnbp4sdjhypfflda9jwr' );
define( 'NONCE_SALT',       'm9lyvymcetgbp4hbcmveghkxpgez1t05ercvbixgmyiiqcgizarn5rnbpgfjk65o' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpyr_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
