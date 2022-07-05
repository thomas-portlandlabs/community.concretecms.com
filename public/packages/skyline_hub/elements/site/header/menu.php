<?php

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Support\Facade\Url;

/** @var $urlHelper Url */
?>

<div class="row row-cols-auto align-items-center">
    <?php if (!empty($itemsPerPageOptions)) { ?>
        <div class="dropdown">
            <button
                type="button"
                class="btn btn-secondary p-2 dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
            
            <span id="selected-option">
                <?php echo $itemsPerPage; ?>
            </span>
        </button>
        
        <ul class="dropdown-menu">
            <li class="dropdown-header">
                <?php echo t('Items per page') ?>
            </li>
            
            <?php foreach ($itemsPerPageOptions as $itemsPerPageOption) { ?>
                <?php
                    $url = $urlHelper->setVariable([
                        'itemsPerPage' => $itemsPerPageOption
                    ]);
                ?>
                
                <li data-items-per-page="<?php echo $itemsPerPageOption; ?>">
                    <a class="dropdown-item <?php echo ($itemsPerPageOption === $itemsPerPage) ? 'active' : ''; ?>"
                        href="<?php echo $url ?>">
                        <?php echo $itemsPerPageOption; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
        </div>
    <?php } ?>
    
    <ul class="ccm-dashboard-header-icons">
        <li>
            <a class="ccm-hover-icon" title="<?php echo h(t('New Entry')) ?>" href="<?php echo Url::to("/dashboard/skyline/sites/add");?>">
                <i class="fas fa-plus" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
</div>

