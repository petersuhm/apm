<?php

return [
    // Filtering

    'timezone' => 'UTC',
    'trackFullScanQueries' => true,

    /*
      |--------------------------------------------------------------------------
      | This will save the full sql's including values (password etc). Default: false
      |--------------------------------------------------------------------------
    */
    'showBindings' => false,

    /*
      |--------------------------------------------------------------------------
      | Log database queries to log file in addition to the database. Default: false
      |--------------------------------------------------------------------------
    */
    'saveQueriesToLog' => false,

    /*
      |--------------------------------------------------------------------------
      | Clean up database after x days (both request & queries)
      |--------------------------------------------------------------------------
    */
    'keepLogFor' => 30,
];