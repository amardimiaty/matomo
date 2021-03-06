<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Referrers\Columns;

use Piwik\Common;
use Piwik\Tracker\Request;
use Piwik\Tracker\Visitor;
use Piwik\Tracker\Action;

class ReferrerUrl extends Base
{
    protected $columnName = 'referer_url';
    protected $columnType = 'VARCHAR(4000) NULL';
    protected $type = self::TYPE_TEXT;
    protected $segmentName = 'referrerUrl';
    protected $nameSingular = 'Live_Referrer_URL';
    protected $namePlural = 'Referrers_ReferrerURLs';
    protected $category = 'Referrers_Referrers';
    protected $acceptValues = 'http%3A%2F%2Fwww.example.org%2Freferer-page.htm';

    /**
     * @param Request $request
     * @param Visitor $visitor
     * @param Action|null $action
     * @return mixed
     */
    public function onNewVisit(Request $request, Visitor $visitor, $action)
    {
        $information = $this->getReferrerInformationFromRequest($request, $visitor);

        return $information['referer_url'];
    }

    public function onExistingVisit(Request $request, Visitor $visitor, $action)
    {
        $information = $this->getReferrerInformationFromRequest($request, $visitor);
        if ($this->isCurrentReferrerDirectEntry($visitor)
            && $information['referer_type'] != Common::REFERRER_TYPE_DIRECT_ENTRY
        ) {
            return $information['referer_url'];
        }

        return false;
    }
}
