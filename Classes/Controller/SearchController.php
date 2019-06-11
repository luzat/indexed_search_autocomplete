<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Sebastian Schmal - INGENIUMDESIGN <info@ingeniumdesign.de>
 *  All rights reserved
 *
 *  This file is part of the "indexed_search" Extension for TYPO3 CMS.
 *
 *  For the full copyright and license information, please read the
 *  LICENSE file that was distributed with this source code.
 *
 * ************************************************************* */

namespace Id\IndexedSearchAutocomplete\Controller;

use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * EntryController
 */
class SearchController extends ActionController {

    /**
     * Search repository
     *
     * @var \TYPO3\CMS\IndexedSearch\Domain\Repository\IndexSearchRepository
     */
    protected $searchRepository;
    
     /**
      * Search functions
      * 
      * @var \Id\IndexedSearchAutocomplete\Service\SearchService
      * @Inject
      */
    protected $searchService;

    /**
     * action search
     *
     * @return string
     */
    public function searchAction() {
        $arg = $_REQUEST;
        $searchmode = $arg['m'];
        $result = $searchmode === 'word'
            ? $this->searchService->searchAWord($arg, $arg['mr'])
            : $this->searchService->searchASite($arg, $arg['mr']);

        foreach ($result as $key => $value) {
            $this->view->assign($key, $value);
        }
    }
}
