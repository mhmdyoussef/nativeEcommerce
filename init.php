<?php

// connecting database
function makeDBQuery($sql, $get_last_id = false) {
    //connect DB
    $dsn    = "mysql:host=localhost;dbname=shop";
    $user   = "root";
    $pass   = "root";

    $optopn = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    try {

        $con = new PDO($dsn,$user,$pass,$optopn);
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql_query = $sql;
        $query = $con->prepare($sql_query);
        $query->execute();

        if (!$get_last_id) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return $con->lastInsertId();
        }

    } catch (PDOException $e){
        echo "faild to connect " . $e->getMessage();
    } finally {
        $con = null;
    }
}