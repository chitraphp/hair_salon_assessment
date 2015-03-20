<?php

    /**
    * @backupGlobals disabled
    *$backupStaticAttribute disabled
    */
    require_once "src/Stylist.php";
    $DB = new PDO('pgsql:host=localhost;dbname=test_hair_salon');
    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function testGetId()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_id, $stylist_name);

            //Act
            $result = $test_stylist->getStylistId();

            //Assert
            $this->assertEquals(1, $result);
        }
    }
?>
