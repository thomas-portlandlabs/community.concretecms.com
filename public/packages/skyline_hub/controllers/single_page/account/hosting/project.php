<?php

namespace Concrete\Package\SkylineHub\Controller\SinglePage\Account\Hosting;

use Concrete\Core\Page\Controller\AccountPageController;
use Concrete\Core\Utility\Service\Number;
use Doctrine\ORM\EntityManager;
use PortlandLabs\Skyline\Command\TerminateHostingTrialSiteCommand;
use PortlandLabs\Skyline\Entity\Site;

class Project extends AccountPageController
{

    public function on_start()
    {
        parent::on_start();
        $this->requireAsset('skyline/frontend');
        $this->set('token', $this->app->make('token'));
    }

    protected function protect($id = null): Site
    {
        $entityManager = $this->app->make(EntityManager::class);
        $entry = $entityManager->find(Site::class, $id);
        if (!$entry) {
            throw new \Exception(t('Invalid site.'));
        }
        $profile = $this->get('profile');
        if ($entry->getAuthor()->getUserID() !== $profile->getUserID()) {
            throw new \Exception(t('You do not have access to edit this site.'));
        }
        $this->set('hostingSite', $entry);
        return $entry;
    }

    public function view($uuid = null)
    {
        $hostingSite = $this->protect($uuid);
        $this->set('numberHelper', new Number());
        if ($hostingSite->getStatus() == Site::STATUS_INSTALLING) {
            $this->render('/account/hosting/project/install');
        } else {
            $this->render('/account/hosting/project/details');
        }
    }

    public function cancel_trial($uuid = null)
    {
        $hostingSite = $this->protect($uuid);
        if ($hostingSite->getSubscriptionStatus() == Site::SUBSCRIPTION_STATUS_TRIALING) {
            if (!$this->get('token')->validate('cancel_trial')) {
                throw new \Exception($this->get('token')->getErrorMessage());
            } else {
                $command = new TerminateHostingTrialSiteCommand($hostingSite->getId());
                $this->executeCommand($command);
                $this->flash('success', t('Trial cancelled.'));
                return $this->buildRedirect(['/account/hosting/']);
            }
        } else {
            throw new \Exception(t('This site is not a trial.'));
        }
    }
}