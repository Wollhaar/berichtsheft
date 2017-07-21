<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');




class DB_Instructor extends DB_Connection
{

    public function getInstructor(){
        $this->getConnection();

        try {
            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare('SELECT name, vorname, role, location, imgPath FROM recordbook.instructor');

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
}
