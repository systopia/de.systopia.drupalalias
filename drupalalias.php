<?php
/*-------------------------------------------------------+
| Drupal Aliases                                         |
| Copyright (C) 2016 SYSTOPIA                            |
+--------------------------------------------------------+
| This program is released as free software under the    |
| Affero GPL license. You can redistribute it and/or     |
| modify it under the terms of this license which you    |
| can read by viewing the included agpl.txt or online    |
| at www.gnu.org/licenses/agpl.html. Removal of this     |
| copyright header is strictly prohibited without        |
| written permission from the original author(s).        |
+--------------------------------------------------------*/

require_once 'drupalalias.civix.php';


/**
 * MAIN FUNCTION: simply replace all civicrm URLs 
 *  with their Drupal aliases in the content blob
 *
 * This function is called by the various hooks below
 */ 
function drupalalias_replace(&$content) {
  // compile regular expression
  $config = CRM_Core_Config::singleton();
  $matches = array();
  $pattern = "|{$config->userFrameworkBaseURL}(?<url>civicrm/[\w/?=&]+)|";

  // find related URLs in $content
  if (preg_match_all($pattern, $content, $matches)) {
    foreach ($matches[1] as $url) {
      $alias = drupal_get_path_alias($url);
      if ($alias != $url) {
        $content = str_replace($url, $alias, $content);
      }
    }
  }
}

/**
 * We will provide our own Mailer (wrapping the original one).
 * so we can replace all the URLs in outgoing emails
 */
function drupalalias_civicrm_alterMailer(&$mailer, $driver, $params) {
  $mailer = new CRM_Drupalalias_Mailer($mailer);
}

/**
 * Replace URLs in the predefined page(s) / snippets
 */
function drupalalias_civicrm_alterContent( &$content, $context, $tplName, &$object ) {
  if (   $tplName == 'CRM/Campaign/Page/Petition/ThankYou.tpl'
      || $tplName == 'CRM/Campaign/Page/Petition/Confirm.tpl'
      || $tplName == 'CRM/Campaign/Form/Petition/Signature.tpl') {
    drupalalias_replace($content);
  }
}

/******************************
 **       CIVIX Hooks        **
 *****************************/

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function drupalalias_civicrm_config(&$config) {
  _drupalalias_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function drupalalias_civicrm_install() {
  _drupalalias_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function drupalalias_civicrm_enable() {
  _drupalalias_civix_civicrm_enable();
}
