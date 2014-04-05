<?php

namespace MediatorPattern{
    abstract class Mediator {
        protected $events = array();

        /**
         * Method to add a new event listener to the event bus.
         * New events can easily be created by giving them a name.
         *
         * Example
         * $loggerId = $eventBus->attach('LogEvents', new Logger());
         *
         * @param string $eventName
         * @param Colleague $colleague
         * @return string
         * @throws \Exception
         */
        public function attach($eventName, Colleague $colleague)
        {
            if(!isset($this->events[$eventName])){
                $this->events[$eventName] = array();
            }

            $this->events[$eventName][$colleague->getId()] = $colleague;
            return $colleague->getId();
        }

        /**
         * Removes a event listener from the event bus.
         *
         * Example
         * $eventBus->detach('LogEvents', $loggerId);
         *
         * @param string $eventName
         * @param string $colleagueId
         * @internal param \MediatorPattern\Colleague $colleague
         */
        public function detach($eventName, $colleagueId)
        {
            if(isset($this->events[$eventName][$colleagueId])) {
                unset($this->events[$eventName][$colleagueId]);
            }
        }

        /**
         * With notify the listeners are only being informed that
         * the event to which there are described to has been fired. No data will be shared between colleagues.
         *
         * @param $eventName
         * @internal param null $data
         */
        public function notify($eventName)
        {
            if(!isset($this->events[$eventName])) {
                return;
            }
            /** @var $colleague Colleague */
            foreach($this->events{$eventName} as $colleague) {
                $colleague->ping($eventName);
            }
        }

        public function handle($eventName, array $data)
        {
            if(!isset($this->events[$eventName])) {
                return $data;
            }
            /** @var $colleague Colleague */
            foreach($this->events[$eventName] as $colleague) {
                $data = $colleague->execute($eventName, $data);
                if($colleague->hasStopped()) {
                    break;
                }
            }
        }
    }
}