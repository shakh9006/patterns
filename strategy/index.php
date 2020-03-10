<?php

abstract class Question
{
    protected $prompt;
    protected $marker;

    public function __construct( $prompt, Marker $marker )
    {
         $this->prompt = $prompt;
         $this->marker = $marker;
    }

    public function mark( $response )
    {
        return $this->marker->mark( $response );
    }
}

abstract class Marker
{
    protected $test;

    public function __construct( $test )
    {
        $this->test = $test;
    }

    abstract function mark($response);
}

class AVQuestion   extends Question {}
class TextQuestion extends Question {}

class MarkLogicMarker extends  Marker
{
    public function mark($response)
    {
        // TODO: Implement mark() method.
        return true;
    }
}

class MatchMarker extends Marker
{
    public function mark($response)
    {
        // TODO: Implement mark() method.
        return $this->test === $response;
    }
}

class RegExpMarker extends Marker
{
    public function mark($response)
    {
        // TODO: Implement mark() method.
        return preg_match($this->test, $response);
    }
}


$markers = [
    new RegExpMarker("/f.ve/"),
    new MatchMarker("five"),
    new MarkLogicMarker(':$input equals five'),
];

foreach ($markers as $marker)
{
    echo get_class($marker) . "<br>";
    $question = new TextQuestion("How many times Brazil won WC", $marker);

    foreach (["five", "four", "zero"] as $response)
    {
        echo " ". $response . ": ";
        if($question->mark($response))
        {
            echo "Correct<br>";
        }else{
            echo "Wrong!<br>";
        }
    }

}