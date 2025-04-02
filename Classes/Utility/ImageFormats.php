<?php

namespace WapplerSystems\Newslayouts\Utility;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ImageFormats implements SingletonInterface
{
    /**
     * Get available template layouts for a certain page
     *
     * @param int $pageUid
     */
    public function getAvailableImageFormats($pageUid): array
    {
        $imageFormats = [];

        // Check if the layouts are extended by ext_tables
        if (isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['imageFormats'])
            && is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['imageFormats'])
        ) {
            $imageFormats = $GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['imageFormats'];
        }

        // Add TsConfig values
        foreach ($this->getImageFormatsFromTsConfig($pageUid) as $imageFormat => $title) {
            if (is_string($title) && str_starts_with($title, '--div--')) {
                $optGroupParts = GeneralUtility::trimExplode(',', $title, true, 2);
                $title = $optGroupParts[1];
                $imageFormat = $optGroupParts[0];
            }
            $imageFormats[] = [$title, $imageFormat];
        }

        return $imageFormats;
    }

    /**
     * Get template layouts defined in TsConfig
     *
     * @param $pageUid
     */
    protected function getImageFormatsFromTsConfig(int $pageUid): array
    {
        $imageFormats = [];
        $pagesTsConfig = BackendUtility::getPagesTSconfig($pageUid);
        if (isset($pagesTsConfig['tx_news.']['imageFormats.']) && is_array($pagesTsConfig['tx_news.']['imageFormats.'])) {
            $imageFormats = $pagesTsConfig['tx_news.']['imageFormats.'];
        }
        return $imageFormats;
    }
}
