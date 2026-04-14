<?php

namespace WapplerSystems\Newslayouts\ViewHelpers;


use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class TagViewHelper extends AbstractTagBasedViewHelper
{

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('name', 'string', 'Tag name', true);
    }

    /**
     * @return string
     */
    public function render(): string
    {
        /** @var string $tagName */
        $tagName = $this->arguments['name'];
        /** @var string $content */
        $content = $this->renderChildren();

        $this->tag->setTagName($tagName);
        $this->tag->setContent($content);

        return $this->tag->render();
    }
}
