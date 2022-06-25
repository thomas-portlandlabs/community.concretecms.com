<?php

namespace Concrete\Package\SkylineClient\Block\NewSkylineSiteWizard;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Html\Service\Navigation;
use Concrete\Core\User\User;
use PortlandLabs\Skyline\Stripe\StripeService;

class Controller extends BlockController
{
    public function getBlockTypeDescription()
    {
        return t('Creates a wizard interface to select a new Skyline Hosting project.');
    }

    public function getBlockTypeName()
    {
        return t('Skyline Wizard');
    }

    public function view()
    {
        $this->set('token', $this->app->make('token'));
        $this->set('u', $this->app->make(User::class));
        $this->set('navigation', $this->app->make(Navigation::class));
    }

    public function action_create_site()
    {
        $token = $this->app->make('token');
        if ($token->validate('create_site')) {
            $user = $this->app->make(User::class);
            $userinfo = $user->getUserInfoObject();
            $service = $this->app->make(StripeService::class);
            $customer = $service->getCustomer($userinfo);
        }
    }
}
