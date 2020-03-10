<?php

abstract class Expression
{
    private $key;
    private static $keyCount = 0;

    abstract function interpreter(InterpreterContext $context);

    public function getKey()
    {
        if (!isset($this->key)) {
            self::$keyCount++;
            $this->key = self::$keyCount;
        }

        return $this->key;
    }
}

class InterpreterContext
{
    private $expressionStore = [];

    public function replace(Expression $exp, $value){
        $this->expressionStore[$exp->getKey()] = $value;
    }

    public function lookup(Expression $exp){
        return $this->expressionStore[$exp->getKey()];
    }

    public function getExpressionStore()
    {
        return $this->expressionStore;
    }
}

class LiteralExpression extends Expression
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function interpreter(InterpreterContext $context)
    {
        // TODO: Implement interpreter() method.
        $context->replace($this, $this->value);
    }


}

class VariableExpression extends Expression {
    private $val;
    private $name;

    public function __construct($name, $val = null)
    {
        $this->name = $name;
        $this->val = $val;
    }

    public function interpreter(InterpreterContext $context)
    {
        // TODO: Implement interpreter() method.
        if( !is_null($this->val) )
        {
            $context->replace($this, $this->val);
            $this->val = null;
        }
    }

    public function setValue($value)
    {
        $this->val = $value;
    }

    public function getKey()
    {
        return $this->name;
    }
}

abstract class OperatorExpression extends Expression
{
    private $l_op;
    private $r_op;

    public function __construct(Expression $l_op, Expression $r_op)
    {
        $this->l_op = $l_op;
        $this->r_op = $r_op;
    }

    public function interpreter(InterpreterContext $context)
    {
        // TODO: Implement interpreter() method.
        $this->l_op->interpreter($context);
        $this->r_op->interpreter($context);
        $l_result = $context->lookup($this->l_op);
        $r_result = $context->lookup($this->r_op);
        $this->doInterpreter($context, $l_result, $r_result);
    }

    abstract protected function doInterpreter(InterpreterContext $context, $l_result, $r_result);
}

class BooleanOrExpression extends OperatorExpression
{
    public function doInterpreter(InterpreterContext $context, $l_result, $r_result)
    {
        // TODO: Implement doInterpreter() method.
        $context->replace($this, $l_result || $r_result);
    }
}

class BooleanAndExpression extends OperatorExpression
{
    protected function doInterpreter(InterpreterContext $context, $l_result, $r_result)
    {
        // TODO: Implement doInterpreter() method.
        $context->replace($this, $l_result && $r_result);
    }
}

class EqualExpression extends OperatorExpression
{
    protected function doInterpreter(InterpreterContext $context, $l_result, $r_result)
    {
        // TODO: Implement doInterpreter() method.
        $context->replace($this, $l_result === $l_result);
    }
}

$context = new InterpreterContext();
$input = new VariableExpression('input');

$statement = new BooleanOrExpression(
    new EqualExpression($input, new LiteralExpression(5)),
    new EqualExpression($input, new LiteralExpression('five'))
);

foreach (array("five", 5, "4") as $value)
{
    $input->setValue($value);
    echo $value . "<br>";
    $statement->interpreter($context);

    if($context->lookup($statement)){
        echo  "+<br>";
    }else {
        echo "-<br>";
    }
}