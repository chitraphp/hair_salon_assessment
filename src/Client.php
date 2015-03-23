<?php

    require_once "Stylist.php";
    class Client
    {
        private $client_id;
        private $client_name;
        private $stylist_id;

        function __construct($client_id = null,$client_name,$stylist_id)
        {
            $this->client_id = $client_id;
            $this->client_name = $client_name;
            $this->stylist_id = $stylist_id;
        }

        function setClientId($new_id)
        {
            $this->client_id = $new_id;
        }

        function setClientName($new_name)
        {
            $this->client_name = $new_name;
        }

        function setStylistId($new_stylist)
        {
            $this->stylist_id = $new_stylist;
        }

        function getClientId()
        {
            return $this->client_id;
        }

        function getClientName()
        {
            return $this->client_name;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function save()
        {
            // $statement = $GLOBALS['DB']->query("INSERT INTO clients (client_name, stylist_id) VALUES ('{$this->getClientName()}',{$this->getStylistId()}) RETURNING id;");
            // $result = $statement->fetch(PDO::FETCH_ASSOC);
            // $this->setClientId($result['id']);
            $statement = $GLOBALS['DB']->query("INSERT INTO clients (client_name, stylist_id) VALUES ('{$this->getClientName()}',{$this->getStylistId()})");
            $last_id = $GLOBALS['DB']->lastInsertId();
            $this->setClientId($last_id);
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client){
                $client_id = $client['client_id'];
                $client_name = $client['client_name'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($client_id, $client_name, $stylist_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            //$GLOBALS['DB']->exec("DELETE FROM clients *;");
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        static function find($search_id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach($clients as $client){
                $client_id = $client->getClientId();
                if($client_id == $search_id){
                    $found_client = $client;
                }
            }

            return $found_client;
        }

        function updateClient($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET client_name = '{$new_name}' WHERE client_id = {$this->getClientId()};");
            $this->setClientName($new_name);
        }

        function deleteClient($delete_client_id)
        {
            $clients = Client::getAll();
            foreach($clients as $client)
            {
              $client_id = $client->getClientId();
              if($client_id == $delete_client_id){
                $GLOBALS['DB']->exec("DELETE FROM clients WHERE client_id = {$delete_client_id};");
              }
            }
        }












    }
?>
