<?php

include($_SERVER['DOCUMENT_ROOT'] . '/Resources/PHP/model/DBManager/DB_Connection.php');


class DB_Instructor
{
    private $dbc;

    public function getConnection()
    {
        $this->dbc = new DB_Connection();;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();
        }
    }

    public function getInstructor(){
        $this->getConnection();
        try {
            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare('SELECT name, vorname, role FROM recordbook.instructor');

            $sth->execute();
            $record = $sth->fetchAll(PDO::FETCH_ASSOC);

            return $_SESSION['instructors'] = $record;

            $this->dbc->commit();



        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }

        return true;
    }
}
