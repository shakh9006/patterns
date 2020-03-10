<?php

class RequestHelper {}

abstract class ProcessRequest {
    abstract function process(RequestHelper $req);
}

class MainProcess extends ProcessRequest {
    public function process(RequestHelper $req)
    {
        // TODO: Implement process() method.
        echo  __CLASS__ ." processing request<br>";
    }
}

abstract class DecorateRequest extends ProcessRequest
{
    protected $processRequest;

    public function __construct(ProcessRequest $req)
    {
        $this->processRequest = $req;
    }
}

class LogRequest extends DecorateRequest
{
    public function process(RequestHelper $req)
    {
        // TODO: Implement process() method.
        $this->processRequest->process($req);
        echo __CLASS__ . " logging request<br>";
    }
}

class AuthenticateRequest extends DecorateRequest
{
    public function process(RequestHelper $req)
    {
        // TODO: Implement process() method.
        $this->processRequest->process($req);
        echo __CLASS__ . " authenticate request <br>";
    }
}

class StructureRequest extends DecorateRequest
{
    public function process(RequestHelper $req)
    {
        // TODO: Implement process() method.
        $this->processRequest->process($req);
        echo __CLASS__ . " structured request <br>";
    }
}

$process = new AuthenticateRequest(new StructureRequest(new LogRequest(new MainProcess())));
$process->process(new RequestHelper());
