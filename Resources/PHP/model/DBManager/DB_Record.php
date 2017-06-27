<?php
require_once('DB_Connection.php');

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

    public function restoreTabels()
    {
        $this->dbc = new DB_Connection();

        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {

            $this->dbc = $this->dbc->getConnection();

            try {

                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('CREATE TABLE recordday ( 
                user INT UNSIGNED ZEROFILL NOT NULL , 
                record INT NOT NULL 
                )
                CHARACTER SET utf8_general_ci');

                $sth->execute();

                $sth = $this->dbc->prepare('CREATE TABLE record (
                record_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                status VARCHAR(200) NULL,
                place VARCHAR(200) NULL,
                record LONGTEXT NULL, 
                comment LONGTEXT NULL,
                attachment_id INT UNSIGNED NULL,
                recorddate timestamp NOT NULL,
                PRIMARY KEY(record_id))
                CHARACTER SET utf8_general_ci');

                $sth->execute();

                $sth = $this->dbc->prepare('CREATE TABLE attachment(
                attachment_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                filename VARCHAR(100)NULL,
                filepath VARCHAR(200)NULL,
                format VARCHAR(10) NULL,
                PRIMARY KEY(attachment_id))
                CHARACTER SET utf8_general_ci');

                $sth->execute();
                $this->dbc->commit();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }

    public function dropTabels()
    {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('DROP TABLE recordbook.recordday');
                $sth->execute();
                $sth = $this->dbc->prepare('DROP TABLE recordbook.record');
                $sth->execute();
                $sth = $this->dbc->prepare('DROP TABLE recordbook.attachment');
                $sth->execute();

                $this->dbc->commit();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }

    public function writeRecord($recDayId, $record, $comment)
    {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();
            try {
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('INSERT INTO   record (torecordday, record, comment) VALUES (' . $recDayId . ', "' . $record . '",  "' . $comment . '")');
                $sth->execute();

                $this->dbc->commit();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }

    public function getRecordPageWeek()
    {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $output = [['recordDate']['status']['place']['record']];
                $endtime = time() + (5 * 24 * 60 * 60);

                $this->dbc->beginTransaction();
                for ($timestamp = time(); $timestamp < $endtime; $timestamp += (1 * 24 * 60 * 60)) {
                    $currentDate = date('Y-m-d', $timestamp);

                    $sth = $this->dbc->prepare
                    ('SELECT 
                            recordday.recordDate, 
                            recordday.status, 
                            recordday.place,
                            record.record
                        FROM recordbook.recordday JOIN recordbook.record
                        WHERE recordday.recordDate = "' . $currentDate . '"
                        AND recordday.record = record.torecordday'
                    );

                    $sth->execute();
                    $record = $sth->fetchAll(PDO::FETCH_ASSOC);
                    $output += $record;

                    if (empty($record) == true) {
                        $sth = $this->dbc->prepare
                        ('SELECT 
                                recordday.recordDate, 
                                recordday.status, 
                                recordday.place 
                            FROM recordbook.recordday  
                            WHERE recordday.recordDate = "' . $currentDate . '"'
                        );
                        $sth->execute();
                        $record = $sth->fetchAll(PDO::FETCH_ASSOC);
                        $output += $record;
                    }
                }

                $this->dbc->commit();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }

        return $output;
    }

    public function getRecordMonth($yeahr, $month)
    {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            //$output = [['recordDate']['status']['place']['record']];
            $output = [];

            if (checkdate($month, 28, $yeahr) == true) {
                $lastDayOfMonth = new DateTime();
                $lastDayOfMonth->setDate($yeahr, $month, 28);
                $lastDayOfMonth = date('Y-m-d',
                    $lastDayOfMonth->getTimestamp());
            }
            if (checkdate($month, 31, $yeahr) == true) {
                $lastDayOfMonth = new DateTime();
                $lastDayOfMonth->setDate($yeahr, $month, 31);
                $lastDayOfMonth = date('Y-m-d',
                    $lastDayOfMonth->getTimestamp());
            }
            if (checkdate($month, 30, $yeahr) == true) {
                $lastDayOfMonth = new DateTime();
                $lastDayOfMonth->setDate($yeahr, $month, 30);
                $lastDayOfMonth = date('Y-m-d',
                    $lastDayOfMonth->getTimestamp());
            }

            try {

                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare
                ('SELECT 
                            recordday.recordDate, 
                            recordday.status, 
                            recordday.place,
                            record.record
                        FROM recordbook.recordday JOIN recordbook.record
                        WHERE recordday.recordDate <= "' . $lastDayOfMonth . '"
                        AND recordday.record = record.torecordday'
                );

                $sth->execute();

                $record = $sth->fetchAll(PDO::FETCH_ASSOC);
                $output += $record;

                $sth = $this->dbc->prepare
                ('SELECT 
                            recordday.recordDate, 
                            recordday.status, 
                            recordday.place 
                        FROM recordbook.recordday  
                        WHERE recordday.recordDate <= "' . $lastDayOfMonth . '"'
                );

                $sth->execute();
                $record = $sth->fetchAll(PDO::FETCH_ASSOC);
                $output += $record;
                $this->dbc->commit();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
            return $output;
        }
    }

    public function writeRecordDay()
    {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('INSERT INTO recordday(place, status, record, attachment) VALUES ()');
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }

    public function createRecordMonth($month, $year)
    {
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $this->dbc->beginTransaktion();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }

    public function recordOut()
    {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('SELECT * FROM recordbook.record');
                $sth->execute();

                echo '<pre>';
                var_dump($sth->fetchAll());

                $this->dbc->commit();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
    }
}