<?php

namespace WapplerSystems\Newslayouts\Frontend\DataProcessing;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\DataProcessing\FilesProcessor;
use TYPO3\CMS\Frontend\Resource\FileCollector;

class DummyImageProcessor extends FilesProcessor
{

    /**
     * Process data of a record to resolve File objects to the view
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }

        // gather data
        $fileCollector = GeneralUtility::makeInstance(FileCollector::class);

        // references / relations
        if (
            (isset($processorConfiguration['references']) && $processorConfiguration['references'])
            || (isset($processorConfiguration['references.']) && $processorConfiguration['references.'])
        ) {
            $referencesUidList = (string)$cObj->stdWrapValue('references', $processorConfiguration);
            $referencesUids = GeneralUtility::intExplode(',', $referencesUidList, true);
            $fileCollector->addFileReferences($referencesUids);

            if (!empty($processorConfiguration['references.'])) {
                $referenceConfiguration = $processorConfiguration['references.'];
                $relationField = $cObj->stdWrapValue('fieldName', $referenceConfiguration);

                // If no reference fieldName is set, there's nothing to do
                if (!empty($relationField)) {
                    // Fetch the references of the default element
                    $relationTable = $cObj->stdWrapValue('table', $referenceConfiguration, $cObj->getCurrentTable());
                    if (!empty($relationTable)) {
                        $fileCollector->addFilesFromRelation($relationTable, $relationField, $cObj->data);
                    }
                }
            }
        }

        // files
        $files = $cObj->stdWrapValue('files', $processorConfiguration);
        if ($files) {
            $files = GeneralUtility::intExplode(',', (string)$files, true);
            $fileCollector->addFiles($files);
        }

        // collections
        $collections = $cObj->stdWrapValue('collections', $processorConfiguration);
        if (!empty($collections)) {
            $collections = GeneralUtility::intExplode(',', (string)$collections, true);
            $fileCollector->addFilesFromFileCollections($collections);
        }

        // folders
        $folders = $cObj->stdWrapValue('folders', $processorConfiguration);
        if (!empty($folders)) {
            $folders = GeneralUtility::trimExplode(',', (string)$folders, true);
            $fileCollector->addFilesFromFolders($folders, !empty($processorConfiguration['folders.']['recursive']));
        }

        // make sure to sort the files
        $sortingProperty = $cObj->stdWrapValue('sorting', $processorConfiguration);
        if ($sortingProperty) {
            $sortingDirection = $cObj->stdWrapValue(
                'direction',
                $processorConfiguration['sorting.'] ?? [],
                'ascending'
            );

            $fileCollector->sort($sortingProperty, $sortingDirection);
        }

        $files = $fileCollector->getFiles();
        if (count($files) > 0) {
            $processedData['data']['dummyImage'] = $files[0];
        } else {
            $processedData['data']['dummyImage'] = null;
        }
        return $processedData;
    }


}
