<?php

namespace OSJ\Service;

use OSJ\Service\LinkService;

class AutomatedLinks
{
    protected $linkService;

    public function __construct()
    {
        $this->linkService = new LinkService;
    }

    public function lastColumns()
    {
        
    }
}