<?php

namespace WapplerSystems\Newslayouts\Domain\Model;

use GeorgRinger\News\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * News
 */
class News extends \GeorgRinger\News\Domain\Model\News
{


    /**
     *
     *
     * @var string
     */
    protected string $layout = '';

    /**
     *
     * @var ObjectStorage<FileReference>
     */
    #[Lazy]
    protected $gallery;


    public function __construct()
    {
        parent::__construct();
        $this->gallery = new ObjectStorage();
    }


    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param string $layout
     */
    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }


    /**
     * Get the Fal media items
     *
     * @return ObjectStorage<FileReference>|null
     */
    public function getGallery(): ?ObjectStorage
    {
        return $this->falMedia;
    }


}
