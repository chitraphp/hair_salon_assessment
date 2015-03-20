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
            $this->$stylist_id = $stylist_id
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
            $statement = $GLOBALS['DB']->query("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getClientName()}',{$this->getStylistId()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setClientId($result['id']);
        }


















    }
?>
