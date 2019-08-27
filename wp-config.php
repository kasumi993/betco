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
define( 'DB_NAME', 'local' );

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
define('AUTH_KEY',         '75YpyHFU+6IMUtebnso9oPKYjhBaz+ramcT+4dfd4bimCFk6lJxSgpg/2iSXfIOwcGHgV2fOL0cse1TenRk5ow==');
define('SECURE_AUTH_KEY',  'aXoI7ZeP+DWNWrQKwYtCKkAw8Yzmmzv5RTwPVDh4oOaUqdQknBl4IsycU7M37vH/ysRcWEh2PvXRoJGrfuAwOg==');
define('LOGGED_IN_KEY',    'AIHrdDh7ZURam1R2bwh3s2rSJb9+fxh+fPTBNFjehqgXX+q+WSnarJNGxcqG/8U6jz9K6WS7CgFT9D6hKjLKhw==');
define('NONCE_KEY',        'X8llXmg5JNEFDhJoN8dn4wVgVOYc4vdprkRhVo+h2bBEzYMKxpItn3CN5Pp3MJ2Qrj+oHI1CDHePOex2rwknbw==');
define('AUTH_SALT',        '6WM/edqgj1Uwh1Spkyn3QfZx5IEK7pflXaOwjEEPacevpNm9gb6EKBfzOy7m6dmzlKGZaZvW/Zn7o2fQCqLFHQ==');
define('SECURE_AUTH_SALT', 'hf1eJNKIXZHXOmhB1B4W5RK0uzKURukevjka+VoT3ZC2Ob5Y+KgUsWMQDjVMGZ1jZsR+Be0YqI8EDSha/kudLA==');
define('LOGGED_IN_SALT',   '/s/0t1AsDkNjoppqBv9/KLTYXsghCzxhXt9FLVvhYVa1X1Che7woOvlVZPWiSgLwlkJnjgKcFmYGUP5YMUst1Q==');
define('NONCE_SALT',       'oPKJnw5NcH46cF4ub4NVN11g68m/voG8NBL8nK6+NYIqIxj1MCUqAGI990n6J2/SKeMVaZ4iolfnCfYWYdDETw==');

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
