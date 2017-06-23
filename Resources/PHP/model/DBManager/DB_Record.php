<?php
require_once ('DB_Connection.php');

class DB_Record
{
    private $dbc;

    public function deleteDatabase($db)
    {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();


            try {
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('DROP DATABASE IF EXISTS ' . $db); //berichtsheft
                $sth->execute();
                $this->dbc->commit();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }

    public function createDatabase($db)
    {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();


            try {
                $sth = $this->dbc->prepare('CREATE DATABASE ' . $db);
                $sth->bindParam(':db', $db);
                $sth->execute();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception);
            }
        }
    }

    public function restoreTabels(){
        $this->dbc = new DB_Connection();

        if(isset($this->dbc) || is_a($this->dbc, 'PDO')){

            $this->dbc = $this->dbc->getConnection();

            try{

                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('CREATE TABLE recordbook.recordday (
                id_recordday INT NOT NULL AUTO_INCREMENT,
                status VARCHAR(200),
                place VARCHAR(200),
                attachment INT,
                record INT,
                recordDate DATE,
                PRIMARY KEY(id_recordday))');

                $sth->execute();


                $sth = $this->dbc->prepare('CREATE TABLE recordbook.record (
                id_record INT NOT NULL AUTO_INCREMENT,
                torecordday INT,
                record LONGTEXT,
                comment LONGTEXT,
                PRIMARY KEY(id_record))');

                $sth->execute();

                $sth = $this->dbc->prepare('CREATE TABLE recordbook.attachment(
                id_attachment INT NOT NULL AUTO_INCREMENT,
                filename VARCHAR(100),
                filepath VARCHAR(200),
                torecordday INT,
                PRIMARY KEY(id_attachment))');

                $sth->execute();
                $this->dbc->commit();

            }catch(PDOException $exception){
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }

    public function dropTabels(){
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try{
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('DROP TABLE recordbook.recordday');
                $sth->execute();
                $sth = $this->dbc->prepare('DROP TABLE recordbook.record');
                $sth->execute();
                $sth = $this->dbc->prepare('DROP TABLE recordbook.attachment');
                $sth->execute();

                $this->dbc->commit();

            }catch(PDOException $exception){
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }

    }

    public function writeRecord($recDayId, $record, $comment){
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();
            try{
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('INSERT INTO   record (torecordday, record, comment) VALUES ('. $recDayId .', "' . $record . '",  "' . $comment . '")');
                $sth->execute();


                $this->dbc->commit();


            }catch(PDOException $exception){
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }

    public function getRecordPage(){
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try{
                //$timestamp = time(); // - (21 * 24 * 60 * 60);
                //$currentDate = date('Y-m-d', $timestamp);
                $output = array(['recordDate']['status']['place']['record']);

                $endtime = time()+(5 * 24 * 60 * 60);


                $this->dbc->beginTransaction();
                for($timestamp = time(); $timestamp<$endtime; $timestamp+=(1 * 24 * 60 * 60)){
                    $currentDate = date('Y-m-d', $timestamp);

                    $sth = $this->dbc->prepare
                    ('SELECT 
                            recordday.recordDate, 
                            recordday.status, 
                            recordday.place,
                            record.record
                        FROM recordbook.recordday JOIN recordbook.record
                        WHERE recordday.recordDate = "' . $currentDate .'"
                        AND recordday.record = record.torecordday'
                    );  //' . $currentDate .'

                    $sth->execute();
                    $record = $sth->fetchAll(PDO::FETCH_ASSOC);
                    $output += $record;

                    if(empty($record)==true){
                        $sth = $this->dbc->prepare
                        ('SELECT 
                                recordday.recordDate, 
                                recordday.status, 
                                recordday.place 
                            FROM recordbook.recordday  
                            WHERE recordday.recordDate = "' . $currentDate .'"'
                        );
                        $sth->execute();
                        $record = $sth->fetchAll(PDO::FETCH_ASSOC);
                        $output += $record;
                    }
                }

                $this->dbc->commit();



            }catch(PDOException $exception){
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }

        return $output;
    }



    public function writeRecordDay(){
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try{
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('INSERT INTO recordday(place, status, record, attachment) VALUES ()');


            }catch(PDOException $exception){
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }


    public function createRecordMonth($month, $year){
        /*
         * To Do
         * Prüfung ob Monat schon einmal erzeugt wurde
         * Februar muss noch eingebaut werden
         * umbau der prepare statments:
         *  ->Datenübergabe in die executes verschieben andernfalls ist das prepare statment witzlos
         */

        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try{

                $this->dbc->beginTransaction();
                if(checkdate($month, 31, $year) == true){

                    $day = 31;
                    for($i=0; $i<$day; $i++){
                        $dateSth = new DateTime();
                        $dateSth->setDate($year, $month, ($i+1));

                        $sth = $this->dbc->prepare('INSERT INTO recordday(recordDate) VALUES ('. $dateSth->format('Y-m-d') .')');

                        $sth->execute();


                    }
                }
                if(checkdate($month, 30, $year) == true){

                    $day = 30;
                    for($i=0; $i<$day; $i++){

                        $dateSth = new DateTime();
                        $dateSth->setDate($year, $month, ($i+1));

                        $sth = $this->dbc->prepare('INSERT INTO recordday(recordDate) VALUES ("'. $dateSth->format('Y-m-d') .'")');

                        echo '<pre>' . $sth->queryString;

                        $sth->execute();

                    }
                }

                $this->dbc->commit();


            }catch(PDOException $exception){
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }


    public function recordOut(){
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try{
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('SELECT * FROM recordbook.record');
                $sth->execute();

                echo '<pre>';
                var_dump($sth->fetchAll());

                $this->dbc->commit();


            }catch(PDOException $exception){
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }
}




/*
                 * Diese Abfrage wenn es Berichtheft Eintäge gibt
                 * Andernfals gibt dieses Query NULL zurück

                $sth = $this->dbc->prepare
                ('SELECT
                            recordday.recordDate,
                            recordday.status,
                            recordday.place,
                            record.record
                        FROM recordbook.recordday JOIN recordbook.record
                        WHERE recordday.recordDate = "' . $currentDate .'"
                        AND recordday.record = record.torecordday'
                );  //' . $currentDate .'

                $sth->execute();
                $output = $sth->fetchAll(PDO::FETCH_ASSOC);



                if(empty($output)==true){
                    $sth = $this->dbc->prepare
                    ('SELECT
                                recordday.recordDate,
                                recordday.status,
                                recordday.place
                            FROM recordbook.recordday
                            WHERE recordday.recordDate = "' . $currentDate .'"'
                    );
                    $sth->execute();
                    $output = $sth->fetchAll(PDO::FETCH_ASSOC);
                }


                $this->dbc->commit();

                */
