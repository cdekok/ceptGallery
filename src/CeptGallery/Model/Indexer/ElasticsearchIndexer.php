<?php
namespace CeptGallery\Model\Indexer;

class ElasticsearchIndexer implements IndexerInterface
{
    /**
     *
     * @var \Elasticsearch\Client
     */
    protected $client;

    /**
     * Elastic search index
     * @var array
     */
    protected $indexParams;

    /**
     *
     * @param \Elasticsearch\Client $client
     * @param array $options
     */
    public function __construct(\Elasticsearch\Client $client, $indexParams = ['index' => 'gallery'])
    {
        $this->client = $client;
        $this->indexParams = $indexParams;
    }

    public function index($path)
    {
       if (is_dir(!$path)) {
           throw new Indexer\Exception\InvalidArgumentException('Not a dir'.$path);
       }

       $this->client->indices()->create($this->indexParams);

       $iterator =  new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
       foreach ($iterator as $item) {
           if ($item->isFile()) {
               $row = [
                   'id' => md5((string)$item),
                   'index' => $this->indexParams['index'],
                   'type' => 'image',
                   'body' => [
                        'location' => (string)$item,
                   ]
                ];
               $this->client->index($row);
           }
       }
    }
}