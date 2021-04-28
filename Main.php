<?php

namespace IdnoPlugins\Unlock;

use Idno\Common\Entity;
use Idno\Common\Page;
use Idno\Common\Plugin;
use Idno\Core\Idno;

class Main extends Plugin
{
    function registerPages()
    {
        \Idno\Core\Idno::site()->routes()->addRoute('/admin/unlock/?', 'IdnoPlugins\Unlock\Pages\Admin');
    }

    function registerContentTypes()
    {
        \Idno\Core\Idno::site()->template()->extendTemplate('shell/head', 'unlock/head');
        \Idno\Core\Idno::site()->template()->extendTemplate('shell/beforecontent', 'unlock/beforecontent');
        \Idno\Core\Idno::site()->template()->extendTemplate('admin/menu/items', 'unlock/menu');
        \Idno\Core\Idno::site()->template()->extendTemplate('entity/annotations/comment/main', 'unlock/comment');
        \Idno\Core\Idno::site()->template()->prependTemplate('content/access', 'unlock/access');
    }

    function registerEventHooks()
    {
        $events = \Idno\Core\Idno::site()->events();
        $events->addListener('publish', function (\Idno\Core\Event $event) {
            $entity = $event->data()['object'];
            $page = Idno::site()->currentPage();

            $unlockLock = $page->getInput('unlockLock', '');
            if ($entity->unlockLock != $unlockLock) {
                $entity->unlockLock = $unlockLock;
            }
            $unlockTeaser = $page->getInput('unlockTeaser', '');
            if ($entity->unlockTeaser != $unlockTeaser) {
                $entity->unlockTeaser = $unlockTeaser;
            }
            return $entity;
        });
        $events->addListener('entity/draw', function (\Idno\Core\Event $event) {
            $entity = $event->data()['object'];
            $page = Idno::site()->currentPage();

            if ($lockAddress = self::getLockAddress($page, $entity)) {
                if (!$page->isPermalink() && !($entity instanceof \IdnoPlugins\Status\Status)) {
                    $t = clone Idno::site()->template();
                    $event->setResponse($t->__(['object' => $entity])->draw('unlock/entity', true));
                }
            }
        });
    }

    static function getLockAddress($page = false, $entity = false)
    {
        $lockAddress = null;
        $currentPage = $page instanceof Page ? $page : \Idno\Core\Idno::site()->currentPage();
        $entity = $entity instanceof Entity ? $entity : $entity = $currentPage->getEntity();

        // First, let's see if we're behind a site-wide lock (and not on a walled garden free page)
        if (\Idno\Core\Idno::site()->config()->unlockLock && !\Idno\Core\Idno::site()->routes()->isRoutePublic($currentPage->getFullClassName())) {
            $lockAddress = \Idno\Core\Idno::site()->config()->unlockLock;
        }

        // Then, let's see if the current page has a lock on it
        if ($entity instanceof Entity) {
            if ($unlockLock = $entity->unlockLock) {
                $lockAddress = $entity->unlockLock;
            }
        }

        return $lockAddress;
    }
}
