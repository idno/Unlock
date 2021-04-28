<?php

namespace IdnoPlugins\Unlock\Pages;

use Idno\Common\Entity;

class Admin extends \Idno\Common\Page
{

    function getContent()
    {

        $this->adminGatekeeper();

        $site = \Idno\Core\Idno::site();
        $template = \Idno\Core\Idno::site()->template();

        $template->__([
            'title' => $site->language()->_('Unlock'),
            'body' => $template->__(['lock' => $site->config()->unlockLock])->draw('unlock/admin')
        ])->drawPage();

    }

    function postContent()
    {

        $this->adminGatekeeper();
        $config = \Idno\Core\Idno::site()->config();

        $unlockLock = trim($this->getInput('unlockLock', ''));

        $unlockLockAddrs = $this->getInput('unlockLockAddrs');
        $unlockLockNames = $this->getInput('unlockLockNames');

        var_export($unlockLockNames); var_export($unlockLockAddrs);

        $locks = [];

        if (is_array($unlockLockNames) && is_array($unlockLockAddrs)) {
            if (count($unlockLockNames) === count($unlockLockAddrs)) {
                foreach($unlockLockNames as $index => $name) {
                    if (!empty($unlockLockAddrs[$index])) {
                        if (empty($name)) $name = $unlockLockAddrs[$index];
                        $locks[$unlockLockAddrs[$index]] = $name;
                    }
                }
            }
        }

        $config->unlockLocks = $locks;
        $config->unlockLock = $unlockLock;
        $config->save();

        $this->forward($config->getDisplayURL() . 'admin/unlock/');

    }

}
