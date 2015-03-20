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
            $statement = $GLOBALS['DB']->query("INSERT INTO stylist (stylist_name) VALUES ('{$this->getStylistName()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylist;");
            $stylists = array();
            foreach($returned_stylists as $stylist){
                $stylist_id = $stylist['id'];
                $stylist_name = $stylist['stylist_name'];
                $new_stylist = new Stylist($stylist_id, $stylist_name);
                array_push($stylist, $new_stylist);
            }
            return $stylists;
        }







    }
?>
