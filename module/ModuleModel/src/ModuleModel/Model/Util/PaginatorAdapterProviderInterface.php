<?php

namespace ModuleModel\Model\Util;

interface PaginatorAdapterProviderInterface
{
    /**
     * @return \ModuleModel\Model\Util\PaginatorAdapter
     */
    public function getPaginatorAdapter();
}
