<?php
namespace Learning\Magestore\Observer;
class ChangeDisplayText implements \Magento\Framework\Event\ObserverInterface{

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $data = $observer -> getData('mp_text');
        echo $data->getText()."- event";
        $data -> setText('executed');
        return $this;

    }
}
