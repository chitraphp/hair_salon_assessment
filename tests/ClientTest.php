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
            Stylist::deleteAll();
        }

        function testGetId()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_id, $stylist_name);
            $test_stylist->save();

            $client_name = "H2k Infosys";
            $client_id = 1;
            $stylist_id = $test_stylist->getStylistId();
            $test_client = new Client($client_id, $client_name, $stylist_id);
            $test_client->save();

            //Act
            $result = $test_client->getClientId();

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

            $client_name = "H2k Infosys";
            $client_id = 1;
            $stylist_id = $test_stylist->getStylistId();
            $test_client = new Client($client_id, $client_name, $stylist_id);
            $test_client->save();

            //Act
            $result = $test_client->getClientName();

            //Assert
            $this->assertEquals($client_name, $result);

        }

        function testGetStylistId()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_id, $stylist_name);
            $test_stylist->save();

            $client_name = "H2k Infosys";
            $client_id = 1;
            $stylist_id = $test_stylist->getStylistId();
            $test_client = new Client($client_id, $client_name, $stylist_id);
            $test_client->save();

            //Act
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals($stylist_id, $result);

        }

        function testSetId()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_id, $stylist_name);
            $test_stylist->save();

            $client_name = "H2k Infosys";
            $client_id = 1;
            $stylist_id = $test_stylist->getStylistId();
            $test_client = new Client($client_id, $client_name, $stylist_id);
            $test_client->save();

            //Act
            $test_client->setClientId(6);

            //Assert
            $result = $test_client->getClientId();
            $this->assertEquals(6, $result);

        }

        function testSetName()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_id, $stylist_name);
            $test_stylist->save();

            $client_name = "H2k Infosys";
            $client_id = 1;
            $stylist_id = $test_stylist->getStylistId();
            $test_client = new Client($client_id, $client_name, $stylist_id);
            $test_client->save();

            //Act
            $test_client->setClientName("kavitha");

            //Assert
            $result = $test_client->getClientName();
            $this->assertEquals("kavitha", $result);

        }


        function testSetStylistId()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_id, $stylist_name);
            $test_stylist->save();

            $client_name = "H2k Infosys";
            $client_id = 1;
            $stylist_id = $test_stylist->getStylistId();
            $test_client = new Client($client_id, $client_name, $stylist_id);
            $test_client->save();

            //Act
            $test_client->setStylistId(6);

            //Assert
            $result = $test_client->getStylistId();
            $this->assertEquals(6, $result);

        }


        function testSave()
        {
            //Arrange
            $stylist_name = "chitra";
            $stylist_id = 1;
            $test_stylist = new Stylist($stylist_id, $stylist_name);
            $test_stylist->save();

            $client_name = "H2k Infosys";
            $client_id = 1;
            $stylist_id = $test_stylist->getStylistId();
            $test_client = new Client($client_id, $client_name, $stylist_id);
            $test_client->save();

            $client_name2 = "Bagya";
            $client_id2 = 1;
            $stylist_id = $test_stylist->getStylistId();
            $test_client2 = new Client($client_id, $client_name, $stylist_id);
            $test_client2->save();



            //Act
            $test_client->save();

            //Assert
            $result = Client::getAll();
            $this->assertEquals($test_client2, $result[1]);

        }






















    }
?>
