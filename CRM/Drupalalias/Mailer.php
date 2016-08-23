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

/**
 * Wrapper for CiviCRM Mailer
 */
class CRM_Drupalalias_Mailer {

  /**
   * this is the orginal, wrapped mailer
   */
  protected $mailer = NULL;

  /**
   * construct this mailer wrapping another one
   */
  public function __construct($mailer) {
    $this->mailer = $mailer;
  }

  /**
   * Send an email via the wrapped mailer,
   *  replacing the URLs contained
   */
  function send($recipients, $headers, $body) {
    foreach ($headers as &$header) {
      drupalalias_replace($header);
    }
    drupalalias_replace($body);
    $this->mailer->send($recipients, $headers, $body);
  }
}
