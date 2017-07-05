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

    public function writeRecordbookDummy()
    {
        /*
         * Erzeugt in der DB Recordbook in der Tabelle record
         * für die unten angegebenen Zeiträume hier 1 Moonat Dummy Datensätze
         * mit Blindtexten
         */

        $timestamp = new DateTime();
        $schoolTime = new DateTime();
        $schoolTime->setDate(2017, 06, 30);
        $checkTime = new DateTime();
        $checkTime->setDate(2017, 06, 18);

        echo '<pre>';

        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();
            try {
                $this->dbc->beginTransaction();
                for ($timestamp->setDate(2017, 06,
                    01); $timestamp <= $schoolTime; $timestamp->add(new DateInterval('P1D'))) {

                    $status = "'Anwesend'";
                    $place = "'Schule'";
                    $comment = "'Eine wunderbare Heiterkeit hat meine ganze Seele eingenommen, gleich den süßen Frühlingsmorgen, die ich mit ganzem Herzen genieße. Ich bin allein und freue mich meines Lebens in dieser Gegend, die für solche Seelen geschaffen ist wie die meine. Ich bin so glücklich, mein Bester, so ganz in dem Gefühle von ruhigem Dasein versunken, daß meine Kunst darunter leidet.'";
                    $record = "'Lorem ipsum dolor sit amet  consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes  nascetur ridiculus mus. Donec quam felis  ultricies nec  pellentesque eu  pretium quis  sem. Nulla consequat massa quis enim. Donec pede justo  fringilla vel  aliquet nec  vulputate eget  arcu. In enim justo  rhoncus ut  imperdiet a  venenatis vitae  justo. Nullam dictum felis eu pede mollis pretium.'";
                    $recorddate = $timestamp;
                    $recorddate = $recorddate->format('Y-m-d G:i:s');
                    $attachment_id = 1;

                    $sth = $this->dbc->prepare
                    ('INSERT INTO recordbook.record(status, place, record, comment,  recorddate, attachment_id) VALUE (' . $status . ', ' . $place . ', ' . $record . ', ' . $comment . ', "' . $recorddate . '", ' . $attachment_id . ')');

                    $sth->execute();
                }


                //---------------- Ende des record Dummy Eintrag -------------------------------

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
                            record.record_id,
                            record.recordDate, 
                            record.status, 
                            record.place,
                            record.record
                        FROM record.recordday JOIN recordbook.record
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

// getting all records from one user
    public function recordOut($user){
        $this->dbc = new DB_Connection();
        $output = NULL;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('SELECT user_id FROM User WHERE username = ?');
                $sth->execute(array($user));
                $u_id = $sth->fetch();

                $sth = $this->dbc->prepare('SELECT record_id, status, place, record.record AS records, comment, recorddate FROM record LEFT JOIN recordbook ON record.record_id = recordbook.record WHERE user = ?');
                $sth->execute(array($u_id['user_id']));
                $output = $sth->fetchAll();
//var_dump($user, $u_id);
                /*echo '<pre>';
                var_dump($output);
                echo '</pre>';*/

                $this->dbc->commit();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
        return $output;
    }

    // getting single record
    public function getRecord($id){
        $this->dbc = new DB_Connection();
        $output = NULL;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('SELECT * FROM record WHERE record_id = ?');
                $sth->execute(array($id));
                $output = $sth->fetch();

//                var_dump($output);
/*                echo '<pre>';
                var_dump($sth->fetchAll());*/

                $this->dbc->commit();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
        return $output;
    }

// setting or update record
    public function saveRecord($record, $comment = NULL, $id = NULL, $user = NULL){
        $this->dbc = new DB_Connection();
        $output = NULL;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                if (empty($id)) {
                    $this->dbc->beginTransaction();
                    // getting user
                    $sth = $this->dbc->prepare('SELECT user_id FROM User WHERE username = ?');
                    $sth->execute(array($user));
                    $u_id = $sth->fetch();

                    // setting records and parallel connection/relation with user
                    $sth = $this->dbc->prepare('INSERT INTO record (record, comment) VALUES (?, ?); 
                                                        INSERT INTO recordbook (record, user) VALUES (LAST_INSERT_ID(), ?)');
                    $sth->execute(array($record, $comment, $u_id['user_id']));

                }
                elseif (isset($id)) {
                    $this->dbc->beginTransaction();
                    $sth = $this->dbc->prepare('UPDATE record SET record = ?, comment = ? WHERE record_id = ?');
                    $sth->execute(array($record, $comment, $id));
                }
                    $sth = $this->dbc->prepare('SELECT record FROM record WHERE record_id = ?');
                    $sth->execute(array($id));
                    $control = $sth->fetch();

//var_dump($id, ' id', $control);
                if ($control['record'] == $record) {
                    $output = TRUE;
                }
                else {
                    $output = FALSE;
                }

                $this->dbc->commit();
            } catch (PDOException $exception) {
                $this->dbc->rollBack();
                print('Failed: ' . $exception->getMessage());
            }
        }
        return $output;
    }


   /* public function createRecordMonth($month, $year)
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
    }*/



}