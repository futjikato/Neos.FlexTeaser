<?php
namespace Futjikato\FlexTeaser\Service\DataSource;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Neos\Service\DataSource\AbstractDataSource;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;
use TYPO3\TYPO3CR\Domain\Model\NodeType;
use TYPO3\TYPO3CR\Domain\Service\NodeTypeManager;

/**
 * Data source to provide a list of node types to use as itemRenderer
 */
class TeaserRendererDataSource extends AbstractDataSource
{
    /**
     * Name of the mixin used to mark teaser renderer
     */
    const RENDERER_MIXIN_NAME = 'Futjikato.FlexTeaser:RendererMixin';

    /**
     * @var NodeTypeManager
     * @Flow\Inject
     */
    protected $nodeTypeManager;

    /**
     * Data source identifier
     *
     * @var string
     */
    static protected $identifier = 'futjikato-flexteaser-renderer';

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
        $rendererNodeTypes = $this->nodeTypeManager->getSubNodeTypes(self::RENDERER_MIXIN_NAME, false);
        $data = [];
        /** @var NodeType $nodeType */
        foreach ($rendererNodeTypes as $nodeType) {
            $data[] = [
                'value' => $nodeType->getName(),
                'label' => $nodeType->getLabel()
            ];
        }

        return $data;
    }
}