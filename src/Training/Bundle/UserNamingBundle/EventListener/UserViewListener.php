<?php

namespace Training\Bundle\UserNamingBundle\EventListener;

use Oro\Bundle\UIBundle\Event\BeforeListRenderEvent;

/**
 * UserViewListener is executed before rendering of user view page
 */
class UserViewListener
{
    /**
     * Adds Name Parts block to User view page
     *
     * @param BeforeListRenderEvent $event
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function onUserView(BeforeListRenderEvent $event)
    {
        if (!$event->getEntity()) {
            return;
        }

        $currentUser = $event->getEntity();

        $template = $event->getEnvironment()->render(
            '@UserNaming/renderNameParts.html.twig',
            ['entity' => $currentUser]
        );
        $newBlock = $event->getScrollData()->addBlock('Name Parts');
        $newSubBlock = $event->getScrollData()->addSubBlock($newBlock);
        $event->getScrollData()->addSubBlockData($newBlock, $newSubBlock, $template);
    }
}
