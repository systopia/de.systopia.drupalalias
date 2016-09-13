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
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function drupalalias_civicrm_xmlMenu(&$files) {
  _drupalalias_civix_civicrm_xmlMenu($files);
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
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function drupalalias_civicrm_uninstall() {
  _drupalalias_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function drupalalias_civicrm_enable() {
  _drupalalias_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function drupalalias_civicrm_disable() {
  _drupalalias_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function drupalalias_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _drupalalias_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function drupalalias_civicrm_managed(&$entities) {
  _drupalalias_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function drupalalias_civicrm_caseTypes(&$caseTypes) {
  _drupalalias_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function drupalalias_civicrm_angularModules(&$angularModules) {
_drupalalias_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function drupalalias_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _drupalalias_civix_civicrm_alterSettingsFolders($metaDataFolders);
}



