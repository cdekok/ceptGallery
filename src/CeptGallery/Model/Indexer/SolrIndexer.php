<?php
namespace CeptGallery\Model\Indexer;

class SolrIndexer implements IndexerInterface
{
    /**
     *
     * @var \Solarium\Client
     */
    protected $client;

    public function __construct(\Solarium\Client $client)
    {
        $this->client = $client;
    }

    public function index($path)
    {
       if (is_dir(!$path)) {
           throw new Indexer\Exception\InvalidArgumentException('Not a dir'.$path);
       }

       $iterator =  new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
       foreach ($iterator as $item) {
           if ($item->isFile()) {
               echo $item.PHP_EOL;
           }
       }
    }
}