<?php
namespace MediatorPattern {
    class testPlugin extends Colleague
    {
        private $_message = "STANDARD MESSAGE";
        public function ping($eventName)
        {
            echo "Event ".$eventName." has been triggered, someone should do something.\n";
            echo $this->_message."\n";
        }

        public function execute($eventName, array $parameters)
        {
            echo "A new User with the name " . $parameters['UserName'] . " has been created\n";
            if($parameters['UserName'] == 'Bobby Tables') {
                $this->stopEvent();
                $parameters['UserName'] = 'Fu Bar';
            }
            return $parameters;
        }

        public function __construct($pluginName, $message)
        {
            $this->_message = $message;
            parent::__construct($pluginName);
        }

        public function setMessage($message)
        {
            $this->_message = $message;
        }
    }
}