<?php
namespace CeptGallery\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ConsoleController extends AbstractActionController
{
    public function indexerAction()
    {
        $request = $this->getRequest();
        $path = $request->getParam('path');
        return $path.PHP_EOL;
    }
}