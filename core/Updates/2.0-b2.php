<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 * @category Piwik
 * @package Piwik
 */

namespace Piwik\Updates;

use Piwik\Common;
use Piwik\Updater;
use Piwik\Updates;

/**
 * @package Updates
 */
class Updates_2_0_b2 extends Updates
{
    static function getSql($schema = 'Myisam')
    {
        return array(
            'ALTER TABLE ' . Common::prefixTable('log_visit')
            . " ADD COLUMN  visit_total_events SMALLINT(5) UNSIGNED NOT NULL AFTER visit_total_searches" => 1060,

            'ALTER TABLE ' . Common::prefixTable('log_link_visit_action')
            . " ADD COLUMN  idaction_event_category INTEGER(10) UNSIGNED AFTER idaction_name_ref,
	            ADD COLUMN  idaction_event_action INTEGER(10) UNSIGNED AFTER idaction_event_category" => 1060,
        );
    }

    static function update()
    {
        Updater::updateDatabase(__FILE__, self::getSql());
    }
}
