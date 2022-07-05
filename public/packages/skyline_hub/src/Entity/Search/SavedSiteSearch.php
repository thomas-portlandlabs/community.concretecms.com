<?php

/**
 *
 * This file was build with the Entity Designer add-on.
 *
 * https://www.concrete5.org/marketplace/addons/entity-designer
 *
 */

/** @noinspection DuplicatedCode */
/** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace PortlandLabs\Skyline\Entity\Search;

use Concrete\Core\Entity\Search\SavedSearch;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`SavedSkylineSiteSearchQueries`")
 */
class SavedSiteSearch extends SavedSearch
{
    /**
    * @var integer
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(name="`id`", type="integer", nullable=true)
    */
    protected $id;
    
}
