<?php


namespace WapplerSystems\Newslayouts\Hooks;

use TYPO3\CMS\Backend\Utility\BackendUtility as BackendUtilityCore;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use WapplerSystems\Newslayouts\Utility\ImageFormats;

class ItemsProcFunc
{

    /**
     * Itemsproc function to extend the selection of cropVariants in the plugin
     *
     * @param array &$config configuration array
     */
    public function imageFormats(array &$config): void
    {
        $currentColPos = $config['flexParentDatabaseRow']['colPos'] ?? null;
        if ($currentColPos === null) {
            return;
        }
        $pageId = $this->getPageId($config['flexParentDatabaseRow']['pid']);

        if ($pageId > 0) {
            $imageFormatsUtility = GeneralUtility::makeInstance(ImageFormats::class);

            $imageFormats = $imageFormatsUtility->getAvailableImageFormats($pageId);

            $imageFormats = $this->reduceImageFormats($imageFormats, $currentColPos);
            foreach ($imageFormats as $imageFormat) {
                $additionalLayout = [
                    htmlspecialchars($this->getLanguageService()->sL($imageFormat[0])),
                    $imageFormat[1],
                ];
                array_push($config['items'], $additionalLayout);
            }
        }
    }

    /**
     * Reduce the template layouts by the ones that are not allowed in given colPos
     *
     * @param array $cropVariants
     * @param int $currentColPos
     */
    protected function reduceImageFormats($cropVariants, $currentColPos): array
    {
        $currentColPos = (int)$currentColPos;
        $restrictions = [];
        $allLayouts = [];
        foreach ($cropVariants as $key => $layout) {
            if (is_array($layout[0])) {
                if (isset($layout[0]['allowedColPos']) && str_ends_with((string)$layout[1], '.')) {
                    $layoutKey = substr($layout[1], 0, -1);
                    $restrictions[$layoutKey] = GeneralUtility::intExplode(',', $layout[0]['allowedColPos'], true);
                }
            } else {
                $allLayouts[$key] = $layout;
            }
        }
        foreach ($restrictions as $restrictedIdentifier => $restrictedColPosList) {
            if (!in_array($currentColPos, $restrictedColPosList, true)) {
                unset($allLayouts[$restrictedIdentifier]);
            }
        }

        return $allLayouts;
    }


    /**
     * Get all languages
     */
    protected function getAllLanguages(): array
    {
        $siteLanguages = [];
        foreach (GeneralUtility::makeInstance(SiteFinder::class)->getAllSites() as $site) {
            foreach ($site->getAllLanguages() as $languageId => $language) {
                if (!isset($siteLanguages[$languageId])) {
                    $siteLanguages[$languageId] = [
                        'uid' => $languageId,
                        'title' => $language->getTitle(),
                    ];
                }
            }
        }
        return $siteLanguages;
    }

    /**
     * Get tt_content record
     *
     * @param int $uid
     */
    protected function getContentElementRow($uid): ?array
    {
        return BackendUtilityCore::getRecord('tt_content', $uid);
    }

    /**
     * Get page id, if negative, then it is a "after record"
     *
     * @param int $pid
     */
    protected function getPageId($pid): int
    {
        $pid = (int)$pid;

        if ($pid > 0) {
            return $pid;
        }

        $row = BackendUtilityCore::getRecord('tt_content', abs($pid), 'uid,pid');
        return $row['pid'];
    }

    /**
     * Returns LanguageService
     */
    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
