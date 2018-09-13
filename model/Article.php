<?php

/**
 * Created by PhpStorm.
 * User: Kayou
 * Date: 10/09/2018
 * Time: 11:39
 */
class Article
{
    public $idarticle;
    public $title;
    public $date;
    public $content;
    public $author;

    /**
     * Article constructor.
     * @param $idarticle
     * @param $title
     * @param $date
     * @param $content
     * @param $author
     */
    public function __construct($idarticle, $title, $date, $content, $author)
    {
        $this->idarticle = $idarticle;
        $this->title = $title;
        $this->date = $date;
        $this->content = $content;
        $this->author = $author;
    }


}
