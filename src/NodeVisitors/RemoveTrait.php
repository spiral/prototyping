<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace Spiral\Prototype\NodeVisitors;

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Prototype\Utils;

/**
 * Remove PrototypeTrait from the class.
 */
final class RemoveTrait extends NodeVisitorAbstract
{
    /**
     * @param Node $node
     * @return int|null|Node|Node[]
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\TraitUse) {
            return null;
        }

        foreach ($node->traits as $index => $use) {
            if ($use instanceof Node\Name) {
                $name = $this->trimSlashes(join('\\', $use->parts));
                if (
                    in_array($name, [
                    $this->trimSlashes(PrototypeTrait::class),
                    Utils::shortName(PrototypeTrait::class),
                    ], true)
                ) {
                    unset($node->traits[$index]);
                }
            }
        }

        $node->traits = array_values($node->traits);
        if (empty($node->traits)) {
            return NodeTraverser::REMOVE_NODE;
        }

        return $node;
    }

    private function trimSlashes(string $str): string
    {
        return trim($str, '\\');
    }
}
