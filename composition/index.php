<?php

abstract class Lesson
{
    private $duration;
    private $costStrategy;

    public function __construct($duration, CostStrategy $strategy)
    {
        $this->duration = $duration;
        $this->costStrategy = $strategy;
    }

    public function cost()
    {
        return $this->costStrategy->cost($this);
    }

    public function chargeType()
    {
        return $this->costStrategy->chargeType();
    }

    public function getDuration()
    {
        return $this->duration;
    }
}

abstract class CostStrategy
{
    abstract function chargeType();

    abstract function cost(Lesson $lesson);
}

class TimedFixedStrategy extends CostStrategy
{
    public function chargeType()
    {
        // TODO: Implement chargeType() method.
        return "timed payment\n";
    }

    public function cost(Lesson $lesson)
    {
        // TODO: Implement cost() method.
        return $lesson->getDuration() * 10;
    }
}

class FixedStrategy extends CostStrategy
{
    public function chargeType()
    {
        // TODO: Implement chargeType() method.
        return "fixed payment";
    }

    public function cost(Lesson $lesson)
    {
        // TODO: Implement cost() method.
        return 30;
    }
}

class RegistrationMgr
{
    public function register(Lesson $lesson)
    {
        $notifier = Notifier::getNotifier();
        return $notifier->inform("New lesson. Price for lesson: {$lesson->cost()}");
    }
}

abstract class Notifier {
    public static function getNotifier()
    {
        if(rand(1,2) === 1)
        {
            return new TextNotifier();
        }

        return new EmailNotifier();
    }

    abstract function inform($message);
}

class TextNotifier extends Notifier {
    public function inform($message)
    {
        // TODO: Implement inform() method.
        return "Text notified. " . $message . "<br>";
    }
}

class EmailNotifier extends Notifier {
    public function inform($message)
    {
        // TODO: Implement inform() method.
        return "Email notified. " . $message . "<br>";
    }
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Lecture extends Lesson {};
class Seminar extends Lesson {};

$register = new RegistrationMgr();
$lessons[] = new Seminar(4, new FixedStrategy());
$lessons[] = new Lecture(4, new TimedFixedStrategy());


foreach ($lessons as $lesson)
{
    echo $register->register($lesson);
}