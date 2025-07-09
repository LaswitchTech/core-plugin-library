<?php

// Import additionnal class into the global namespace
use \LaswitchTech\Core\Abstracts\Model;

class LibraryModel extends Model {

    public function fetch(): array
    {
        // Initialize the Result
        $result = [];

        // List of Libraries
        $libraries = ['countries','states','industries','tags','currencies'];

        // Loop through the Libraries
        foreach($libraries as $library){

            // Create the Query
            $Query = $this->Database->query()
                ->table($library)
                ->select('*')
                ->where('id', 9999, '<>')
                ->where('name', '', '<>');

            // Retrieve the Results
            $result[$library] = $Query->fetch();
        }

        // Return the Results
        return $result;
    }
}
