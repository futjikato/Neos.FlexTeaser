<?php

namespace Futjikato\FlexTeaser\Strategy\BuildIn;

use TYPO3\Eel\FlowQuery\FlowQuery;
use TYPO3\Flow\Annotations as Flow;
use Futjikato\FlexTeaser\Strategy\StrategyInterface;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;

/**
 * Strategy to select the newest child node of the given base page.
 */
class NewestChildStrategy implements StrategyInterface
{
    /**
     * Unique identifier for this strategy
     *
     * @return string
     */
    public function getIdentifier()
    {
        return 'futjikato-newest-child';
    }

    /**
     * Human readable name
     *
     * @return string
     */
    public function getLabel()
    {
        return 'Newest child';
    }

    /**
     * Load newest child page from given base page
     *
     * @param NodeInterface $basePage
     *
     * @return NodeInterface
     */
    public function getTeaserPage(NodeInterface $basePage)
    {
        $fq = new FlowQuery(array($basePage));
        $fq = $fq->find('[instanceof TYPO3.Neos.NodeTypes:Page]');
        $children = $fq->get();

        /** @var NodeInterface $newest */
        $newest = null;
        foreach ($children as $child) {
            if (!($child instanceof NodeInterface)) {
                continue;
            }

            if (!$newest || $newest->getProperty('_creationDateTime') < $child->getIdentifier('_creationDateTime')) {
                $newest = $child;
            }
        }

        return $newest;
    }
}