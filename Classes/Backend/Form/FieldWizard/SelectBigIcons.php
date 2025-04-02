<?php
declare(strict_types=1);
namespace WapplerSystems\Newslayouts\Backend\Form\FieldWizard;


use TYPO3\CMS\Backend\Form\AbstractNode;
use TYPO3\CMS\Backend\Form\Utility\FormEngineUtility;

/**
 * Render thumbnails of icons,
 * typically used with type=group and internal_type=file and file_reference.
 */
class SelectBigIcons extends AbstractNode
{
    /**
     * Render thumbnails of selected files
     *
     * @return array
     */
    public function render(): array
    {
        $result = $this->initializeResultArray();

        $parameterArray = $this->data['parameterArray'];
        $selectItems = $parameterArray['fieldConf']['config']['items'];

        $selectItemCounter = 0;
        foreach ($selectItems as $item) {
            if ($item[1] === '--div--') {
                continue;
            }
            $icon = !empty($item[2]) ? FormEngineUtility::getIconHtml($item[2], $item[0], $item[0]) : '';
            if ($icon) {
                $selectIcons[] = [
                        'title' => $item[0],
                        'icon' => $icon,
                        'index' => $selectItemCounter,
                    ];
            }
            $selectItemCounter++;
        }

        $html = [];
        if (!empty($selectIcons)) {
            $html[] = '<div class="t3js-forms-select-single-icons big-icon-list icon-list">';
            $html[] =    '<div class="row">';
            foreach ($selectIcons as $i => $selectIcon) {
                $html[] =   '<div class="item">';
                if (is_array($selectIcon)) {
                    $html[] = '<a href="#" title="' . htmlspecialchars($selectIcon['title'], ENT_COMPAT, 'UTF-8', false) . '" data-select-index="' . htmlspecialchars((string)$selectIcon['index']) . '">';
                    $html[] =   $selectIcon['icon'];
                    $html[] = '</a>';
                }
                $html[] =   '</div>';
            }
            $html[] =    '</div>';
            $html[] = '</div>';
        }

        $result['html'] = implode(LF, $html);
        return $result;
    }
}
