<?php
namespace Learning\Magestore\Controller\Page;
use Magento\Framework\App\Action\Action;

class DemoEvent extends Action {

    public function execute()
    {
        $textDisplay = new \Magento\Framework\DataObject(array('text' => 'Mageplaza'));
        $this->_eventManager->dispatch('helloworld_display_text', ['mp_text' => $textDisplay]);
        echo $textDisplay->getText();
    }
}
