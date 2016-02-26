<?php

namespace Futjikato\FlexTeaser\Eel\Helper;

use TYPO3\Flow\Annotations as Flow;
use Futjikato\FlexTeaser\Strategy\StrategyStorage;
use TYPO3\Eel\ProtectedContextAwareInterface;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;

/**
 * Eel helper to use
 */
class StrategyHelper implements ProtectedContextAwareInterface
{
    /**
     * @var StrategyStorage
     * @Flow\Inject
     */
    protected $strategyStorage;

    /**
     * Load the page to render as teaser from strategy.
     * Fallback to base page if no strategy is selected.
     *
     * @param string        $strategyIdentifier
     * @param NodeInterface $basePage
     *
     * @return NodeInterface
     */
    public function getTeaserFromStrategy($strategyIdentifier, NodeInterface $basePage)
    {
        $strategy = $this->strategyStorage->getStrategyByIdentifier($strategyIdentifier);
        if (!$strategy) {
            return $basePage;
        }

        return $strategy->getTeaserPage($basePage);
    }

    /**
     * @param string $methodName
     * @return boolean
     */
    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}