<?php
namespace CeptGallery\Controller;

use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\Controller\AbstractActionController;

class ConsoleController extends AbstractActionController
{

    public function setEventManager(EventManagerInterface $events)
    {
        parent::setEventManager($events);
        $events->attach('dispatch', array($this, 'checkRequest'), 10);
    }

    public function checkRequest($e)
    {
        $request  = $e->getRequest();
        if (!$request instanceof \Zend\Console\Request) {
            throw new RuntimeException('Not a console request');
        }
    }

    /**
     * Index images for gallery
     * @return string
     */
    public function indexerAction()
    {
        $request = $this->getRequest();
        $path = $request->getParam('path');
        $solr = $this->getServiceLocator()->get('Config')['ceptGallery']['solr'];
        $solarium = new \Solarium\Client(['endpoint' => $solr]);
        $indexer = new \CeptGallery\Model\Indexer\SolrIndexer($solarium);
        $indexer->index($path);
        return $path.PHP_EOL;
    }
}