<?php

namespace Futjikato\FlexTeaser\Service\DataSource;

use Futjikato\FlexTeaser\Strategy\StrategyStorage;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Neos\Service\DataSource\AbstractDataSource;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;

/**
 *
 */
class TeaserStrategyDataSource extends AbstractDataSource
{
    /**
     * @var StrategyStorage
     * @Flow\Inject
     */
    protected $strategyStorage;

    /**
     * Data source identifier
     *
     * @var string
     */
    static protected $identifier = 'futjikato-flexteaser-strategy';

    /**
     * Get data
     *
     * The return value must be JSON serializable data structure.
     *
     * @param NodeInterface $node The node that is currently edited (optional)
     * @param array $arguments Additional arguments (key / value)
     * @return mixed JSON serializable data
     * @api
     */
    public function getData(NodeInterface $node = null, array $arguments)
    {
        $strategies = $this->strategyStorage->getStrategies();
        $data = [];

        foreach ($strategies as $strategy) {
            $data[] = [
                'value' => $strategy->getIdentifier(),
                'label' => $strategy->getLabel()
            ];
        }

        return $data;
    }
}