<?php

namespace Futjikato\FlexTeaser\Strategy;

use TYPO3\TYPO3CR\Domain\Model\NodeInterface;

/**
 * Interface for all strategies
 */
interface StrategyInterface
{
    /**
     * Unique identifier for this strategy
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Human readable name of the strategy
     *
     * @return string
     */
    public function getLabel();

    /**
     * Load the page that should be shown.
     *
     * @param NodeInterface $basePage
     *
     * @return NodeInterface
     */
    public function getTeaserPage(NodeInterface $basePage);
}