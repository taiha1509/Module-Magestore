<?php
namespace Learning\Magestore\Controller\DemoPlugin;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Example extends Action{
    public $title;

    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        echo $this->setTitle('abcd');
        echo $this->getTitle();
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($text){
        return $this->title = $text;
    }
}
