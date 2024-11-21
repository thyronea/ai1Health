<?php
ob_start(); // output buffering is turned on

// Assign file path to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));

// Project path
define("ADMIN_PATH", PROJECT_PATH . '/admin');
define("PATIENT_PATH", PROJECT_PATH . '/patient');
define("SYSTEM_PATH", PROJECT_PATH . '/system');

// Vendors directory
define("VENDOR_PATH", PROJECT_PATH . '/vendor');
  // Mailer
  define("VENDOR_MAILER_PATH", VENDOR_PATH . '/mailer/PHPMailer/src');
  // CSS
  define("VENDOR_CSS_PATH", VENDOR_PATH . '/css');
  // Scripts
  define("VENDOR_SCRIPTS_PATH", VENDOR_PATH . '/scripts');

  // Private directory
define("PRIVATE_COMPONENTS_PATH", PRIVATE_PATH . '/components');
define("PRIVATE_CONFIG_PATH", PRIVATE_PATH . '/config');
define("PRIVATE_CONTENT_PATH", PRIVATE_PATH . '/content');
define("PRIVATE_CONTROLLERS_PATH", PRIVATE_PATH . '/controllers');
define("PRIVATE_IMG_PATH", PRIVATE_PATH . '/img');
define("PRIVATE_MODELS_PATH", PRIVATE_PATH . '/models');
define("PRIVATE_SCRIPTS_PATH", PRIVATE_PATH . '/scripts');
define("PRIVATE_UPLOADS_PATH", PRIVATE_PATH . '/uploads');
define("PRIVATE_VIEW_PATH", PRIVATE_PATH . '/view');
  // View admin
  define("VIEW_ADMIN", PRIVATE_VIEW_PATH . '/admin');
    // directory
    define("ADMIN_DASHBOARD", VIEW_ADMIN . '/dashboard');
    define("ADMIN_PROFILE", VIEW_ADMIN . '/profile');
    define("ADMIN_PATIENTS", VIEW_ADMIN . '/patients');
    define("ADMIN_PATIENT_CHART", VIEW_ADMIN . '/patient-chart');
    // alerts
  define("VIEW_ALERTS", PRIVATE_VIEW_PATH . '/alerts');
  // forms
  define("VIEW_FORMS", PRIVATE_VIEW_PATH . '/forms');
  // modals
  define("VIEW_MODALS", PRIVATE_VIEW_PATH . '/modals');
  // tables
  define("VIEW_TABLES", PRIVATE_VIEW_PATH . '/tables');

// admin directory
define("ADMIN_COMP_PATH", ADMIN_PATH . '/components');
define("ADMIN_CONTENT_PATH", ADMIN_PATH . '/content');
define("ADMIN_MODAL_PATH", ADMIN_PATH . '/modal');
define("ADMIN_OFFCANVAS_PATH", ADMIN_PATH . '/offcanvas');
define("ADMIN_PAGES_PATH", ADMIN_PATH . '/page');

// public directory
define("SYSTEM_COMPONENT_PATH", SYSTEM_PATH . '/component');
define("SYSTEM_CONFIG_PATH", SYSTEM_PATH . '/config');
define("SYSTEM_CONTENT_PATH", SYSTEM_PATH . '/content');
define("SYSTEM_FORMS_PATH", SYSTEM_PATH . '/forms');
define("SYSTEM_SCRIPTS_PATH", SYSTEM_PATH . '/scripts');
define("SYSTEM_VIEW_PATH", SYSTEM_PATH . '/view');

// Assign the root URL to the PHP constant
// * Do not need to to include the domain
// * Use same document root as webserver
// * Can set a hardcoded value:
// define("WWW_ROOT", '/`htdoc/HC/public`');
// define ("WWW_ROOT", '');
// * Can dynamically find everything in URL up to "/public"
$SYSTEM_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $SYSTEM_end);
define("WWW_ROOT", $doc_root);

// Requires function file once
require_once('functions.php');

?>
