<?php

namespace WapplerSystems\Newslayouts\Domain\Model;

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
    protected $layout = '';

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


}
