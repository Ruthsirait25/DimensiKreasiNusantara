<?php
define('WP_CACHE', true); // Added by WP Cloudflare Super Page Cache
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
// define('WP_DEBUG', true);
// define('WP_DEBUG_LOG', true);
// define('WP_DEBUG_DISPLAY', false);

define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '?vy]?_;U[i&|es7.$>K+l1></rfc,T5$H?7:_!c0.S-P[U5$R}-I}xTFGe_t4+yx' );
define( 'SECURE_AUTH_KEY',  'e-^>oKw6F@U|<BS.Ro4C3[>wzg> TbL&M76jt9`AeYjB#h6+39Y|l_BP)C*956PL' );
define( 'LOGGED_IN_KEY',    '2B~EQpH`iz+j.`@]a+kAFn7(Zt#X5yM]7]}*dh+1_km4TF0xSQ0pn0slkFUHyxz*' );
define( 'NONCE_KEY',        'w([HM(=6PdN6;pLC#fPQ1P(-s(ZZ@R;<]@]N@BVN|=1ZSd[{&}1d6GbjR+CPr614' );
define( 'AUTH_SALT',        'X<aWxvQuagThcZw.8<@?9ELvY@z}DwnE?`N@4++ZCsztbq|-/pi7Uot#K)eRw9C+' );
define( 'SECURE_AUTH_SALT', 'y:,z}oz:~`q=MN47$A3K}SS<s(7-/}[p*^?jF[k, N>jdo+z{<G4PvP%Z ,BT4`Z' );
define( 'LOGGED_IN_SALT',   ']RsFJ34I$:T5:}rs}SC4uU2V>meTWTbpB}%No1ofQ<Fa!K]RKYl{Yu1,sK!6[]g>' );
define( 'NONCE_SALT',       '|dNfWFjwFnV=n&?-7b)Py)iwPkRRoA/ f8cVV}@Jp/#I.`VGx43t2nKf297K%~]~' );

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
* @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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