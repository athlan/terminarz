<?php
namespace ModuleModel\Model\Util;

interface PaginatorAdapterModelInterface
{
    public function fetchAll(array $params = array());
    public function count(array $params = array());
    
    /**
     * 
     * @param array $params
     * @return \ModuleModel\Model\Util\PaginatorAdapter
     */
    public function getPaginatorAdapter(array $params = array());
}
