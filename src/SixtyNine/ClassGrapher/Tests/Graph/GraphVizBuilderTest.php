<?php

namespace SixtyNine\ClassGrapher\Tests\Helper;

use SixtyNine\ClassGrapher\Graph\GraphBuilder;
use SixtyNine\ClassGrapher\Graph\GraphConfig;
use SixtyNine\ClassGrapher\Graph\GraphFontConfig;
use SixtyNine\ClassGrapher\Model\ObjectTableBuilder;
use SixtyNine\ClassGrapher\Graph\GraphRenderer;

class GraphVizBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $expected = <<<EOF
digraph G {

    fontname = "AvantGarde-Book"
    fontsize = 8
    layout = dot
    concentrate = true
    ranksep = 0.5

    node [
        fontname = "AvantGarde-Book"
        fontsize = 8
        fontcolor = black
        shape = "box"
        style = rounded
        height = 0.25
    ]

    edge [
        dir = "back"
        arrowtail = "empty"
    ]

    node_0 [
        label = <<i><b>MyInterface1</b></i>>,
        color=grey40,
        fontname="AvantGarde-Book",
        fontsize=8,
        fontcolor=grey40
    ]
    node_1 [
        label = <<i><b>MyInterface2</b></i>>,
        color=grey40,
        fontname="AvantGarde-Book",
        fontsize=8,
        fontcolor=grey40
    ]
    node_2 [
        label = <<i><b>MyInterface3</b></i>>,
        color=grey40,
        fontname="AvantGarde-Book",
        fontsize=8,
        fontcolor=grey40
    ]
    node_3 [
        label = <MyClass1>,
        color=black,
        fontname="AvantGarde-Book",
        fontsize=8,
        fontcolor=black
    ]
    node_4 [
        label = <GraphViz>,
        color=black,
        fontname="AvantGarde-Book",
        fontsize=8,
        fontcolor=black
    ]
    node_5 [
        label = <MyClass2>,
        color=black,
        fontname="AvantGarde-Book",
        fontsize=8,
        fontcolor=black
    ]
    node_6 [
        label = <MyClass3>,
        color=black,
        fontname="AvantGarde-Book",
        fontsize=8,
        fontcolor=black
    ]
    node_7 [
        label = <MyClass4>,
        color=black,
        fontname="AvantGarde-Book",
        fontsize=8,
        fontcolor=black
    ]
    node_8 [
        label = <MyClass5>,
        color=black,
        fontname="AvantGarde-Book",
        fontsize=8,
        fontcolor=black
    ]

    node_0 -> node_1
    node_0 -> node_2
    node_1 -> node_2
    node_4 -> node_3
    node_0 -> node_5
    node_0 -> node_6
    node_4 -> node_6
    node_0 -> node_7
    node_1 -> node_7


}

EOF;

        $otBuilder = new ObjectTableBuilder();
        $table = $otBuilder->build(__DIR__ . '/../Fixtures');

        $builder = new GraphBuilder();
        $graph = $builder->build($table);

        $renderer = new GraphRenderer();
        $config = new GraphConfig();
        $config
            ->getInterfaceFont()
            ->setColor('grey40')
            ->setStyle(GraphFontConfig::FONT_ITALIC | GraphFontConfig::FONT_BOLD)
        ;
        $config
            ->getBaseFont()
            ->setStyle(GraphFontConfig::FONT_BOLD)
            ->setColor('red')
        ;        $res = $renderer->render($graph, $config);
        $this->assertEquals($expected, $res);
    }
}