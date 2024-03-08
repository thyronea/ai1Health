<?php

ob_start(); // output buffering is turned on

// Assign file path to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));

// private directory
define("PRIVATE_ACCESS_PATH", PRIVATE_PATH . '/access');
define("PRIVATE_COMPONENTS_PATH", PRIVATE_PATH . '/components');
define("PRIVATE_MESSAGES_PATH", PRIVATE_PATH . '/messages');
define("PRIVATE_SECURITY_PATH", PRIVATE_PATH . '/security');
define("PRIVATE_VIEW_PATH", PRIVATE_PATH . '/view');
  // admin
  define("VIEW_ADMIN", PRIVATE_VIEW_PATH . '/admin');
    // directory
    define("ADMIN_COMPONENTS", VIEW_ADMIN . '/components');
    define("ADMIN_CONTENT", VIEW_ADMIN . '/content');
    define("ADMIN_MODAL", VIEW_ADMIN . '/modal');
    define("ADMIN_OFFCANVAS", VIEW_ADMIN . '/offcanvas');
    define("ADMIN_PAGE", VIEW_ADMIN . '/page');
    define("ADMIN_PROCESS", VIEW_ADMIN . '/process');
  // user
  define("VIEW_USER", PRIVATE_VIEW_PATH . '/user');
    // directory
    define("USER_COMPONENTS", VIEW_USER . '/components');
    define("USER_CONTENT", VIEW_USER . '/content');
    define("USER_MODAL", VIEW_USER . '/modal');

// vendors directory
define("VENDOR_PATH", PROJECT_PATH . '/vendor');
  // mailer
  define("VENDOR_MAILER_PATH", VENDOR_PATH . '/mailer');




define("ADMIN_PATH", PROJECT_PATH . '/admin');
define("PATIENT_PATH", PROJECT_PATH . '/patient');
define("PUBLIC_PATH", PROJECT_PATH . '/public');

// admin directory
define("ADMIN_COMP_PATH", ADMIN_PATH . '/components');
define("ADMIN_CONTENT_PATH", ADMIN_PATH . '/content');
define("ADMIN_MODAL_PATH", ADMIN_PATH . '/modal');
define("ADMIN_OFFCANVAS_PATH", ADMIN_PATH . '/offcanvas');
define("ADMIN_PAGES_PATH", ADMIN_PATH . '/page');

// public directory
define("PUBLIC_CONFIG_PATH", PUBLIC_PATH . '/config');
define("PUBLIC_CONTENT_PATH", PUBLIC_PATH . '/content');
define("PUBLIC_FORMS_PATH", PUBLIC_PATH . '/forms');
define("PUBLIC_PAGES_PATH", PUBLIC_PATH . '/page');


// Assign the root URL to the PHP constant
// * Do not need to to include the domain
// * Use same document root as webserver
// * Can set a hardcoded value:
// define("WWW_ROOT", '/`htdoc/HC/public`');
// define ("WWW_ROOT", '');
// * Can dynamically find everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

// Requires function file once
require_once('functions.php');

?>
