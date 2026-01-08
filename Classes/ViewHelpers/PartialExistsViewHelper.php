<?php

namespace WapplerSystems\Newslayouts\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\View\TemplatePaths;

class PartialExistsViewHelper extends AbstractViewHelper
{
    public function initializeArguments()
    {
        $this->registerArgument('partial', 'string', 'Name of the partial', true);
    }

    public function render(): bool
    {
        $partialName = $this->arguments['partial'];

        /** @var TemplatePaths $templatePaths */
        $templatePaths = $this->renderingContext->getTemplatePaths();

        // Get all partial root paths (can be multiple due to overrides)
        $partialRootPaths = $templatePaths->getPartialRootPaths();

        // Convert partial name to path (e.g. My/Partial => My/Partial.html)
        $partialPath = str_replace('/', DIRECTORY_SEPARATOR, $partialName) . '.html';

        // Check all root paths
        foreach ($partialRootPaths as $rootPath) {
            $fullPath = rtrim($rootPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $partialPath;
            if (file_exists($fullPath)) {
                return true;
            }
        }

        return false;
    }
}
