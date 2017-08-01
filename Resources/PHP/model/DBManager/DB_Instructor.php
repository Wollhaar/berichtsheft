<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

include_once ($_SERVER['DOCUMENT_ROOT'] . '/Resources/PHP/model/DBManager/DB_Connection.php');


class DB_Instructor extends DB_Connection
{

    public function getInstructor(){
        $this->getConnection();

        try {
            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare('SELECT name, vorname, role, location, imgPath, content FROM recordbook.instructor');

            $sth->execute();
            $record = $sth->fetchAll(PDO::FETCH_ASSOC);

            return $record;

            $this->dbc->commit();



        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }

        return true;
    }

    public function writeInstructor($name, $vorname, $location, $role, $content){
        $this->getConnection();

        try{
            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare("INSERT INTO instructor (name, vorname, location, role, content) VALUES (?, ?, ?, ?, ?)");

            $sth->bindParam(1, $name, PDO::PARAM_STR);
            $sth->bindParam(2, $vorname, PDO::PARAM_STR);
            $sth->bindParam(3, $location, PDO::PARAM_STR);
            $sth->bindParam(4, $role, PDO::PARAM_STR);
            $sth->bindParam(5, $content, PDO::PARAM_STR);

            $sth->execute();
            $this->dbc->commit();

            return true;


        }catch(PDOException $exception){
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }
    }
}
