<?php

namespace LazyGuy\PhpParse\Helper;

use LazyGuy\PhpParse\Parser\SyntaxTreeNode,
    LazyGuy\PhpParse\Parser\SyntaxTreeVisitorInterface,
    LazyGuy\PhpParse\PHPCR\NodeType\NodeTypeDefinition;

class CndSyntaxTreeNodeVisitor implements SyntaxTreeVisitorInterface
{
    protected $generator;

    protected $nodeTypeDefs = array();

    /**
     * @var \LazyGuy\PhpParse\PHPCR\NodeType\NodeTypeDefinition
     */
    protected $curNodeTypeDef;

    public function __construct(NodeTypeGenerator $generator)
    {
        $this->generator = $generator;
    }

    public function getNodeTypeDefs()
    {
        return $this->nodeTypeDefs;
    }

    public function visit(SyntaxTreeNode $node)
    {
        //var_dump($node->getType());
        
        switch ($node->getType()) {

            case 'nodeTypeDef':
                $this->curNodeTypeDef = new NodeTypeDefinition();
                $this->nodeTypeDefs[] = $this->curNodeTypeDef;
                break;

            case 'nodeTypeName':
                if ($node->hasProperty('value')) {
                    $this->curNodeTypeDef->setName($node->getProperty('value'));
                }
                break;

            case 'supertypes':
                if ($node->hasProperty('value')) {
                    $this->curNodeTypeDef->addDeclaredSupertypeName($node->getProperty('value'));
                }
                break;

            case 'nodeTypeAttributes':
                if ($node->hasChild('orderable')) $this->curNodeTypeDef->setHasOrderableChildNodes(true);
                if ($node->hasChild('mixin')) $this->curNodeTypeDef->setIsMixin(true);
                if ($node->hasChild('abstract')) $this->curNodeTypeDef->setIsAbstract(true);
                if ($node->hasChild('query')) $this->curNodeTypeDef->setIsQueryable(true);
                break;

            // TODO: write the rest
        }
    }

}
