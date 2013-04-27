<?php

namespace ModuleModel\Model\Util;

class PaginatorAdapter implements \Zend\Paginator\Adapter\AdapterInterface
{
    /**
     *
     * @var \ModuleModel\Model\Util\PaginatorAdapterModelInterface
     */
    protected $model;
    
    /**
     *
     * @var array
     */
    protected $params;
    
    /**
     *
     * @param \ModuleModel\Model\Util\PaginatorAdapterModelInterface $model
     * @param array $params
     */
    public function __construct(PaginatorAdapterModelInterface $model, array $params = array()) {
        $this->setModel($model);
        $this->setParams($params);
    }
    
    /**
     * Returns an collection of items for a page.
     *
     * @param  integer $offset Page offset
     * @param  integer $itemCountPerPage Number of items per page
     * @return array
     */
    public function getItems($offset, $itemCountPerPage) {
        $params = $this->getParams();
    
        $params['limit'] = $itemCountPerPage;
        $params['offset'] = $offset;
        
        return $this->getModel()->fetchAll($params);
    }
    
    /**
     * Returns items.
     *
     * @see Countable::count()
     */
    public function count() {
        $params = $this->getParams();
         
        return $this->getModel()->count($params);
    }
    
    /**
     * @return \ModuleModel\Model\Util\PaginatorAdapterModelInterface
     */
    public function getModel() {
        return $this->model;
    }
    
    /**
     * @param \ModuleModel\Model\Util\PaginatorAdapterModelInterface $model
     */
    public function setModel(PaginatorAdapterModelInterface $model) {
        $this->model = $model;
    }
    
    /**
     * @return array
     */
    public function getParams() {
        return $this->params;
    }
    
    /**
     * @param array $params
     */
    public function setParams(array $params) {
        $this->params = $params;
    }
}
