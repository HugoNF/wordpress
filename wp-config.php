<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'my_cv');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'KS0[<<_EET7IUJv4U!jsU0fC%YnEqfK1W<C_7NIi${o]$I@/3+o`qs+DQvoW9Pf$');
define('SECURE_AUTH_KEY',  '7mY<U4VVMCuTre!(o6{5j==,)L)ww)|/*KiFLB7!r^AAP_mcgp!Lvq.8r:Sd>YK_');
define('LOGGED_IN_KEY',    'ssHE%,w#3(lGMzuyqsUlS8?yo<}Rc:RJV[$s]RS7tbo@q%{~LiGuTPIO^yo}nX_M');
define('NONCE_KEY',        'FjD]A?FsFjRur4`2>)l7ccx _,DKQNOs!%0a,z*:;-=-do(Xlg3-W&4jif^]{2/y');
define('AUTH_SALT',        'Q[7(OP#%oQ&DI$NP|RQW{`Q]==B$r(ZV@@&X_03D-$dLn8P&vGkX+D`g9&?qFY!f');
define('SECURE_AUTH_SALT', '.[iEh3j_Mki[tFTjxlZ1`3VR~`S6g+D:4Ci1R4fx<gWq%/4!GD3R/6lKuF}f+`u-');
define('LOGGED_IN_SALT',   'wv+:U76cW`N2y*{LUD}o7Su&EV#uq0;(uqOkDVWWv[<Z]nD7jceL16b!{`<=Q),7');
define('NONCE_SALT',       '/Ho;N$/$!lx7f[sV1TW:&N[615}+mf?EX;|SAs~222S5c9E]5kwg|JMc|6u|gBe8');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');