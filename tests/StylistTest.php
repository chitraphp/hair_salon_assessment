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

        function testGetName()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_id, $stylist_name);
            $test_stylist->save();

            //Act
            $result = $test_stylist->getStylistName();

            //Assert
            $this->assertEquals($stylist_name, $result);
        }

        function testSetId()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_id, $stylist_name);
            $test_stylist->save();

            //Act
            $test_stylist->setStylistId(5);

            //Assert
            $result = $test_stylist->getStylistId();
            $this->assertEquals(5, $result);
        }

        function testSetName()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_id, $stylist_name);
            $test_stylist->save();

            //Act
            $test_stylist->setStylistName("suchith");

            //Assert
            $result = $test_stylist->getStylistName();
            $this->assertEquals("suchith", $result);
        }

        function testSave()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 10;
            $test_stylist = new Stylist($stylist_id, $stylist_name);
            $test_stylist->save();

            $stylist_name2 = "vamsi";
            $stylist_id2 = 30;
            $test_stylist2 = new Stylist($stylist_id2, $stylist_name2);
            $test_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert

            $this->assertEquals([$test_stylist,$test_stylist2], $result);
        }
        


























    }
?>
