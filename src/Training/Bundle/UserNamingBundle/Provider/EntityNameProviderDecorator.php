<?php

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;

/**
 * Decorates EntityNameProvider service to render username using format "<LastName> <FirstName> <MiddleName>"
 */
class EntityNameProviderDecorator implements EntityNameProviderInterface
{
    private EntityNameProviderInterface $decoratedProvider;

    /**
     * @param EntityNameProviderInterface $decoratedProvider
     */
    public function __construct(EntityNameProviderInterface $decoratedProvider)
    {
        $this->decoratedProvider = $decoratedProvider;
    }

    /**
     * @inheritDoc
     */
    public function getName($format, $locale, $entity): string
    {
        return $entity->getLastName() . ' ' . $entity->getFirstName() . ' ' . $entity->getMiddleName();
    }

    /**
     * @inheritDoc
     */
    public function getNameDQL($format, $locale, $className, $alias): string
    {
        return $this->decoratedProvider->getNameDQL($format, $locale, $className, $alias);
    }
}
