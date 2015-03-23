<?php

    /**
    * @backupGlobals disabled
    *$backupStaticAttribute disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    // $DB = new PDO('pgsql:host=localhost;dbname=test_hair_salon');
    // $servername = "localhost";
    // $username = "root";
    // $password = "chitraphp";
    // $DB = new PDO("mysql:host=localhost;dbname=test_hair_salon", $username, $password);
    //try {
    $DB = new PDO('mysql:host=localhost;dbname=test_hair_salon', 'root', 'chitraphp');
  //  $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //  $DB->exec("SET NAMES 'utf8'");
//} catch(PDOException $e) {
    //echo 'ERROR: ' . $e->getMessage();
//echo 'could not connect to server';
//}

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
            $this->assertEquals(true, is_numeric($result));

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
            $client_id2 = 2;
            $stylist_id = $test_stylist->getStylistId();
            $test_client2 = new Client($client_id2, $client_name2, $stylist_id);
            $test_client2->save();



            //Act
            $test_client->save();

            //Assert
            $result = Client::getAll();
            $this->assertEquals($test_client2, $result[1]);

        }

        function testDeleteAll()
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
            $client_id2 = 2;
            $stylist_id = $test_stylist->getStylistId();
            $test_client2 = new Client($client_id2, $client_name2, $stylist_id);
            $test_client2->save();

            //Act
            Client::deleteAll();

            //Assert
            $result = Client::getAll();
            $this->assertEquals([], $result);

        }

        function testFind()
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
            $client_id2 = 2;
            $stylist_id = $test_stylist->getStylistId();
            $test_client2 = new Client($client_id2, $client_name2, $stylist_id);
            $test_client2->save();



            //Act
            $find_id = $test_client2->getClientId();

            //Assert
            $result = Client::find($find_id);
            $this->assertEquals($test_client2, $result);

        }

        function testUpdateClient()
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
            $client_id2 = 2;
            $stylist_id = $test_stylist->getStylistId();
            $test_client2 = new Client($client_id2, $client_name2, $stylist_id);
            $test_client2->save();

            //Act
            $test_client2->updateClient("mavensoft");

            //Assert
            $result = $test_client2->getClientName();
            $this->assertEquals("mavensoft", $result);

        }

        function testDeleteClient()
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
            $client_id2 = 2;
            $stylist_id = $test_stylist->getStylistId();
            $test_client2 = new Client($client_id2, $client_name2, $stylist_id);
            $test_client2->save();

            $client_name3 = "Teksystems";
            $client_id3 = 3;
            $stylist_id = $test_stylist->getStylistId();
            $test_client3 = new Client($client_id3, $client_name3, $stylist_id);
            $test_client3->save();



            //Act
            $client_id = $test_client2->getClientId();
            $test_client2->deleteClient($client_id);

            //Assert
            $result = Client::getAll();
            $this->assertEquals([$test_client,$test_client3], $result);

        }

























    }
?>
