<?php

    /**
    * @backupGlobals disabled
    *$backupStaticAttribute disabled
    */
    require_once "src/Stylist.php";
    // $DB = new PDO('pgsql:host=localhost;dbname=test_hair_salon');

    //  $servername = "localhost";
    //  $username = "root";
    //  $password = "chitraphp";
    //  $DB = new PDO("mysql:host=localhost;dbname=test_hair_salon", $username, $password);
 //     try {
      $DB = new PDO('mysql:host=localhost;dbname=test_hair_salon', 'root', 'chitraphp');
 //     $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 //     $DB->exec("SET NAMES 'utf8'");
 // } catch(PDOException $e) {
 //     //echo 'ERROR: ' . $e->getMessage();
 //     echo 'could not connect to server';
 // }

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
            //$test_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist], $result);
        }

        function testGetAll()
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

        function testUpdateStylist()
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
            $test_stylist2->updateStylist("Richard");
            $result = $test_stylist2->getStylistName();

            //Assert
            $this->assertEquals("Richard", $result);
        }

        function testDeleteStylist()
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
            $test_stylist->deleteStylist($stylist_id);

            //Assert
            $var1 = $test_stylist->getStylistName();
            $result = $test_stylist->getStylistClients();
            //bool $result = if(empty($var1) && empty($var2));
            $this->assertEquals([], $result);
        }

        function testGetStylistClients()
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

            $client_name = "H2k Infosys";
            $client_id = 1;
            $stylist_id = $test_stylist2->getStylistId();
            $test_client = new Client($client_id, $client_name, $stylist_id);
            $test_client->save();

            $client_name2 = "Bagya";
            $client_id2 = 2;
            $stylist_id = $test_stylist2->getStylistId();
            $test_client2 = new Client($client_id2, $client_name2, $stylist_id);
            $test_client2->save();

            //Act
            $result = $test_stylist2->getStylistClients();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function testFind()
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
            $id = $test_stylist2->getStylistId();
            $test_stylist2->find($id);
            $result = $test_stylist2->getStylistName();

            //Assert
            $this->assertEquals("vamsi", $result);
        }

















    }
?>
