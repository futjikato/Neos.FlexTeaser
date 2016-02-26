<?php

namespace Futjikato\FlexTeaser\Strategy;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Object\ObjectManagerInterface;
use TYPO3\Flow\Reflection\ReflectionService;

/**
 * Strategy storage
 *
 * @Flow\Scope("singleton")
 */
class StrategyStorage
{
    /**
     * Storage for strategies
     *
     * @var StrategyInterface[]
     */
    protected $strategies = array();

    /**
     * Reflection service to find strategies.
     *
     * @var ReflectionService
     * @Flow\Inject
     */
    protected $reflectionService;

    /**
     * Object manager to create strategy implementations.
     *
     * @var ObjectManagerInterface
     * @Flow\Inject
     */
    protected $objectManager;

    /**
     * Register a strategy.
     *
     * @param StrategyInterface $strat
     */
    public function registerStrategy(StrategyInterface $strat)
    {
        $this->strategies[$strat->getIdentifier()] = $strat;
    }

    /**
     * Get a strategy by identifier.
     * Return null for unknown identifiers.
     *
     * @param string $identifier
     *
     * @return StrategyInterface|null
     */
    public function getStrategyByIdentifier($identifier)
    {
        if (!array_key_exists($identifier, $this->strategies)) {
            return null;
        }

        return $this->strategies[$identifier];
    }

    /**
     * Return all registered strategies.
     *
     * @return StrategyInterface[]
     */
    public function getStrategies()
    {
        return $this->strategies;
    }

    /**
     * Load all strategies after initialization
     */
    public function initializeObject()
    {
        $interface = 'Futjikato\FlexTeaser\Strategy\StrategyInterface';
        $strategyNames = $this->reflectionService->getAllImplementationClassNamesForInterface($interface);

        foreach ($strategyNames as $className) {
            /** @var StrategyInterface $strategy */
            $strategy = $this->objectManager->get($className);
            $this->registerStrategy($strategy);
        }
    }
}