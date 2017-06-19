<?php
ini_set('display_errors', 1);
error_reporting( E_ALL );
/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 16.06.2017
 * Time: 10:16
 */
class database
{

    public function deleteDatabase($server, $db, $user, $pass)
    {
        try {
            $dbh = new PDO('mysql:host=' . $server, $user, $pass);
            echo '<pre>Connection succsefull</pre>';
        } catch (PDOException $exception) {
            print($exception);
        }

        try {
            $dbh->beginTransaction();
            $sth = $dbh->prepare('DROP DATABASE IF EXISTS ' . $db); //berichtsheft
            $sth->execute();
            $dbh->commit();
        } catch (PDOException $exception) {
            $dbh->rollBack();
            print('Failed: ' . $exception->getMessage());
        }
    }

    public function createDatabase($server, $db, $user, $pass)
    {
        try {
            $dbh = new PDO('mysql:host=' . $server, $user, $pass);
        } catch (PDOException $exception) {
            print('Failed: ' . $exception->getMessage());
        }

        try {
            $sth = $dbh->prepare('CREATE DATABASE ' . $db);
            $sth->bindParam(':db', $db);
            $sth->execute();
        } catch (PDOException $exception) {
            $dbh->rollBack();
            print('Failed: ' . $exception);
        }
    }

    public function restoreTabels($server, $db, $user, $pass)
    {
        try {
            $dbh = new PDO('mysql:host=' . $server, $user, $pass);
            echo '<pre>Verbindung erfolgreich hergestellt</pre>';
        } catch (PDOException $exception) {
            print('Failed: ' . $exception->getMessage());
        }

        try {

            $dbh->beginTransaction();
            echo '<pre>Beginn Transaction</pre>';
            $sth1 = $dbh->prepare('CREATE TABLE recordbook.status (
            id_status INT NOT NULL AUTO_INCREMENT,
            status VARCHAR(45) NULL,
            PRIMARY KEY(id_status))');
            if ($sth1->execute() == false) {
                echo '<pre>SQL Statment fehlerfaht Sth1</pre>';
            }
            $sth1->execute();

            $sth2 = $dbh->prepare('CREATE TABLE recordbook.place (
            id_ort INT NOT NULL AUTO_INCREMENT,
            ort VARCHAR(45) NULL,
            PRIMARY KEY(id_ort))');
            if ($sth2->execute() == false) {
                echo '<pre>SQL Statment fehlerfaht Sth2</pre>';
            } else {
                $sth2->execute();
            }

            $sth3 = $dbh->prepare('CREATE TABLE recordbook.recordday (
            id_recordday INT NOT NULL AUTO_INCREMENT,
            status INT NULL,
            place INT NULL,
            container_data INT NULL,
            container_report INT NULL,
            PRIMARY KEY(id_recordday))');
            if ($sth3->execute() == false) {
                echo '<pre>SQL Statment fehlerfaht Sth3</pre>';
            } else {
                $sth3->execute();
            }

            $sth4 = $dbh->prepare('CREATE TABLE recordbook.data (
            id_data INT NOT NULL AUTO_INCREMENT,
            dataname VARCHAR(500),
            path VARCHAR(500),
            datasize DOUBLE,
            PRIMARY KEY(id_data))');
            if ($sth4->execute() == false) {
                echo '<pre>SQL Statment fehlerfaht Sth4</pre>';
            } else {
                $sth4->execute();
            }

            $sth5 = $dbh->prepare('CREATE TABLE recordbook.recordcontainer (
            id_container_record INT NULL,
            id_record INT NULL)');
            if ($sth5->execute() == false) {
                echo '<pre>SQL Statment fehlerfaht Sth5</pre>';
            } else {
                $sth5->execute();
            }

            $sth6 = $dbh->prepare('CREATE TABLE recordbook.datacontainer (
            id_container_data INT NOT NULL AUTO_INCREMENT,
            id_data INT NULL,
            PRIMARY KEY(id_container_data))');
            if ($sth6->execute() == false) {
                echo '<pre>SQL Statment fehlerfaht Sth6</pre>';
            } else {
                $sth6->execute();
            }

            $sth7 = $dbh->prepare('CREATE TABLE recordbook.recordbook(
            id_recordbook INT NOT NULL AUTO_INCREMENT,
            container_recordday INT,
            PRIMARY KEY(id_recordbook))');
            if ($sth7->execute() == false) {
                echo '<pre>SQL Statment fehlerfaht Sth7</pre>';
            } else {
                $sth7->execute();
            }

            $dbh->commit();
        } catch (PDOException $exception) {
            $dbh->rollBack();
            print('Failed: ' . $exception->getMessage());
        }
    }



}
