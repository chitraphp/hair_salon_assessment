<?php

    /**
    * @backupGlobals disabled
    *$backupStaticAttribute disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $DB = new PDO('pgsql:host=localhost;dbname=test_hair_salon');

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function teardown()
        {
            Client::deleteAll();
        }

        function testGetId()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_id, $stylist_name);
            $test_stylist->save();

            
            $client_name = "H2k Infosys";
            $id = 1;
        }
    }
?>
