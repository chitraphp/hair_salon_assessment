<?php
    class Stylist
    {
        private $stylist_id;
        private $stylist_name;

        function __construct($stylist_id = null,$stylist_name)
        {
            $this->stylist_id = $stylist_id;
            $this->stylist_name = $stylist_name;
        }

        function setStylistId($new_id)
        {
            $this->stylist_id = $new_id;
        }

        function setStylistName($new_name)
        {
            $this->stylist_name = $new_name;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function getStylistName()
        {
            return $this->stylist_name;
        }

        function save()
        {
            // $statement = $GLOBALS['DB']->query("INSERT INTO stylists (stylist_name) VALUES ('{$this->getStylistName()}') RETURNING id;");
            // $result = $statement->fetch(PDO::FETCH_ASSOC);
            // $this->setStylistId($result['id']);
            $statement = $GLOBALS['DB']->query("INSERT INTO stylists (stylist_name) VALUES ('{$this->getStylistName()}')");
            $last_id = $GLOBALS['DB']->lastInsertId();
            $this->setStylistId($last_id);
        }

        static function getAll()
        {
          $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $stylist){
                $stylist_id = $stylist['stylist_id'];
                $stylist_name = $stylist['stylist_name'];
                $new_stylist = new Stylist($stylist_id, $stylist_name);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            //$GLOBALS['DB']->exec("DELETE FROM stylists *;");
            $GLOBALS['DB']->exec("DELETE FROM stylists ;");
        }

        static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist){
                $stylist_id = $stylist->getStylistId();
                if($stylist_id == $search_id){
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }


       function getStylistClients()
        {
            $clients = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getStylistId()};");
            foreach($returned_clients as $client){
                $client_id = $client['client_id'];
                $client_name = $client['client_name'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($client_id, $client_name, $stylist_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        function updateStylist($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET stylist_name = '{$new_name}' WHERE stylist_id = {$this->getStylistId()};");
            $this->setStylistName($new_name);
        }

        function deleteStylist($delete_stylist_id)
        {
          $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$delete_stylist_id} ;");
          $GLOBALS['DB']->exec("DELETE FROM stylists WHERE stylist_id = {$delete_stylist_id} ;");
        }



































    }
?>
