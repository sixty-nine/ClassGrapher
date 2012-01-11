<?php

namespace LazyGuy\ClassGrapher\Tests\Fixtures;

use LazyGuy\ClassGrapher\Graph\GraphViz as Graph;

interface MyInterface1
{

}

interface MyInterface2 extends MyInterface1
{

}

class MyClass1 extends Graph
{

}

class MyClass2 implements MyInterface1
{

}

class MyClass3 extends Graph implements MyInterface1
{

}

class MyClass4 implements MyInterface1, MyInterface2
{

}
