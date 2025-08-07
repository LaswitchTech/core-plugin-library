<?php

// Import additionnal class into the global namespace
use \LaswitchTech\Core\Abstracts\Endpoint;

class LibraryEndpoint extends Endpoint {

    /**
     * Constructor
     */
    public function __construct(){

        // Call Parent Constructor
        parent::__construct();

        // Retrieve the namespace
        $namespace = $this->Request->getNamespace();

        // Set Properties
        switch($namespace){
            case "/library/fetch":
                $this->Public = true;
                $this->Level = 1;
                break;
        }
    }

    /**
     * Fetch Libraries
     */
    public function fetchAction(): array
    {
        // Import Global Variables
        global $LOCALE;

        // Set the default message
        $message = ["status" => 200, "message" => "OK", "data" => []];

        // Retrieve the libraries
        $libraries = $this->Model->Library->fetch();

        // Retrieve Locales
        $libraries['locales'] = $LOCALE->list();
        $libraries['timezones'] = $LOCALE->timezones();

        // Initialize the options
        $options = [];

        // Loop through the libraries
        foreach($libraries as $library => $records){
            foreach($records as $key => $record){
                switch($library){
                    case 'countries':
                        $options[$library][] = ["id" => $record['code'],"text" => $record['name']];
                        break;
                    case 'states':
                        $options[$library][$record['ccode']][] = ["id" => $record['code'],"text" => $record['name']];
                        break;
                    case 'industries':
                    case 'tags':
                        $options[$library][] = ["id" => $record['name'],"text" => $record['name']];
                        break;
                    case 'locales':
                        $options[$library][] = ["id" => $key,"text" => $record];
                        break;
                    case 'timezones':
                        $options[$library][] = ["id" => $record,"text" => $record];
                        break;
                    default:
                        $options[$library][] = ["id" => $record['id'],"text" => $record['name']];
                        break;
                }
            }
        }

        // Set the data
        $message['data'] = ["options" => $options, "libraries" => $libraries];

        // Return the message
        return $message;
    }
}
