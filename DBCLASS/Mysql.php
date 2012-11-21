<?php
namespace ICHI;

use mysqli;

class IF_MYSQL
{
    public function __construct($config)
    {
        $db = new mysqli('localhost','root','dev','iftest');

        if ($db->connect_errno) {
            //todo gestionar ERROR
            echo "Fallo al contenctar a MySQL: " . $db->connect_error;
            die();
        }

        $this->db = $db;
    }

    public function query($query)
    {
        $db = $this->db;
        $result = mysqli_query( $db, $query );

        if (!$result) {
            echo "Fallo al ejecutar la consulta: (" . $db->errno . ") " . $db->error;
        }

        while ($row = $result->fetch_assoc()) {
            $res[] = $row;
        }

        return $res;
    }
}