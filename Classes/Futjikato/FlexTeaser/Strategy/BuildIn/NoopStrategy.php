<?php

namespace Futjikato\FlexTeaser\Strategy\BuildIn;

use Futjikato\FlexTeaser\Strategy\StrategyInterface;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;

/**
 * This strategy always returns the selected base page.
 * This is also the fallback behavior but for ease of use
 * should be available as an option for the user.
 */
class NoopStrategy implements StrategyInterface
{
    /**
     * Unique identifier for this strategy
     *
     * @return string
     */
    public function getIdentifier()
    {
        return 'futjikato-noop';
    }

    /**
     * Human readable name of the strategy
     *
     * @return string
     */
    public function getLabel()
    {
        return 'Selected page';
    }

    /**
     * Load the page that should be shown.
     *
     * @param NodeInterface $basePage
     *
     * @return NodeInterface
     */
    public function getTeaserPage(NodeInterface $basePage)
    {
        return $basePage;
    }
}