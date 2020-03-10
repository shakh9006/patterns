<?php

abstract class ApptEncoder
{
    /**
     * @return string
     */
    abstract function encode();
}

abstract class TtdEncoder
{
    /**
     * @return string
     */
    abstract function encode();
}

abstract class ContactEncoder
{
    /**
     * @return string
     */
    abstract function encode();
}

abstract class CommsManager
{
    /**
     * @return string
     */
    abstract function getHeaderTitle();

    /**
     * @return string
     */
    abstract function getFooterTitle();

    /**
     * @return TtdEncoder
     */
    abstract function getTtdEncoder();

    /**
     * @return ApptEncoder
     */
    abstract function getApptEncoder();

    /**
     * @return ContactEncoder
     */
    abstract function getContactEncoder();
}

class BlogsApptEncoder extends ApptEncoder {

    /**
     * @return string
     */
    public function encode()
    {
        // TODO: Implement encode() method.
        return "Generate to BlogsAppt format";
    }
}

class BlogsTtdtEncoder extends TtdEncoder {

    /**
     * @return string
     */
    public function encode()
    {
        // TODO: Implement encode() method.
        return "Generate to BlogsTtd format";
    }
}

class BlogsContactEncoder extends ContactEncoder {

    /**
     * @return string
     */
    public function encode()
    {
        // TODO: Implement encode() method.
        return "Generate to BlogsContact format";
    }
}

class CommsBlogManager extends CommsManager
{
    /**
     * @return string
     */
    public function getHeaderTitle()
    {
        // TODO: Implement getHeaderTitle() method.
        return "Header title";
    }

    /**
     * @return string
     */
    public function getFooterTitle()
    {
        // TODO: Implement getFooterTitle() method.
        return "Footer title";
    }

    /**
     * @return ApptEncoder
     */
    public function getApptEncoder()
    {
        // TODO: Implement getApptEncoder() method.
        return new BlogsApptEncoder();
    }

    /**
     * @return TtdEncoder
     */
    public function getTtdEncoder()
    {
        // TODO: Implement getApptEncoder() method.
        return new BlogsTtdtEncoder();
    }

    /**
     * @return ContactEncoder
     */
    public function getContactEncoder()
    {
        // TODO: Implement getApptEncoder() method.
        return new BlogsContactEncoder();
    }
}

$blog = new CommsBlogManager();
echo $blog->getHeaderTitle() . "<br>";
echo $blog->getApptEncoder()->encode() . "<br>";
echo $blog->getTtdEncoder()->encode() . "<br>";
echo $blog->getContactEncoder()->encode() . "<br>";
echo $blog->getFooterTitle() . "<br>";