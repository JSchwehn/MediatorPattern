<?php
namespace MediatorPattern {
    abstract class  Colleague {

        private $_colleagueName;
        private $_id = null;
        private $_stopEvent = false;

        /**
         * When a subscribed event has been triggered by the notify()-call, this method will be called.
         *
         * Example
         * public function ping($eventName)
         * {
         *      echo "Event has been triggered, someone should do something.";
         * }
         * @param $eventName
         * @return void
         */
         public abstract function ping($eventName);

        /**
         * When a event has been triggered by the handle()-call this method will be called with optional provided data.
         * This event type is designed to forward the data through the event bus, so that the
         * listeners can be daisy-chained together.
         * If you like to stop the chain after that call, make sure that the method >> stopEvent() << returns true
         *
         * Example
         * public function handle($eventName, EventParameter $params)
         * {
         *      echo "A new User with the name " . $params['UserName'] . " has been created\n";
         *      $params['UserNAme'] = strtolower($params['UserName']);
         *
         *      return $params;
         * }
         * @param $eventName
         * @param $parameters
         * @return mixed
         */
         public abstract function execute($eventName, array $parameters);

        /**
         * If the event chain should be interrupted, then this method must return true.
         * This method will be called right after the execute()-method has been called.
         *
         * @internal param $eventName
         * @return boolean
         */
        public function hasStopped()
        {
            return $this->_stopEvent;
        }

        /**
         * Should the event chain be interrupted, call this method
         */
        public function stopEvent()
        {
            $this->_stopEvent = true;
        }

        /**
         * Should the event chain be continued, than call this method.
         */
        public function startEvent()
        {
            $this->_stopEvent = false;
        }

        /**
         * Returns a unique ID for the object
         *
         * @return string
         */
        public function getId()
        {
            if(is_null($this->_id)) {
                $this->_id = spl_object_hash($this);
            }
            return $this->_id;
        }

        /**
         * Return the given name
         *
         * @return string
         */
        public function getName()
        {
            return $this->_colleagueName;
        }

        /**
         * You would like to give a name to this colleague, here you can do that :)
         * @param $colleagueName
         */
        public function __construct($colleagueName="")
        {
            $this->_colleagueName = $colleagueName;
        }
    }
}