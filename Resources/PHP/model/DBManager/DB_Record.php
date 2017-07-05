<?php
require_once('DB_Connection.php');



class DB_Record
{

    private $dbc;



    public function getConnection(){
        $this->dbc =  new DB_Connection();;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO'))
            $this->dbc = $this->dbc->getConnection();
    }


    public function deleteDatabase()
    {
        $this->getConnection();
        try {
            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare('DROP DATABASE IF EXISTS recordbook');
            $sth->execute();
            $this->dbc->commit();
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }

        return true;
    }

    public function createDatabase()
    {
        $this->getConnection();
        try {
            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare('CREATE DATABASE IF NOT EXISTS recordbook' );
            $sth->execute();

            return '[Success] Database created';
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo '[Error] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine();
            return false;
        }

        return true;
    }

    public function restoreTabels()
    {
        $this->getConnection();
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

            echo '[Success] Tabels restored';
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo'[Error] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine();
            return false;
        }

        return true;

    }

    public function dropTabels()
    {
        $this->getConnection();
        try {
            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare('DROP TABLE IF EXISTS recordbook.recordday');
            $sth->execute();
            $sth = $this->dbc->prepare('DROP TABLE IF EXISTS recordbook.record');
            $sth->execute();
            $sth = $this->dbc->prepare('DROP TABLE IF EXISTS recordbook.attachment');
            $sth->execute();

            $this->dbc->commit();

            echo '[Success] Tables all droped';
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo '[Error] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine();
            return false;
        }

        return true;
    }

    public function writeRecordbookDummy()
    {
        $this->getConnection();
        /*
         * Erzeugt in der DB Recordbook in der Tabelle record
         * für die unten angegebenen Zeiträume hier 1 Monat Dummy Datensätze
         * mit Blindtexten
         */

        $timestamp = new DateTime();
        $schoolTime = new DateTime();
        $schoolTime->setDate(2017, 06, 30);
        $checkTime = new DateTime();
        $checkTime->setDate(2017, 06, 18);


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


            $this->dbc->commit();
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo 'Failed: ' . $exception->getMessage() . 'in Line: ' . $exception->getLine();
            return false;
        }

        return true;
    }

    public function getRecordMonth($yeahr, $month)
    {
        $this->getConnection();

        if (checkdate($month, 28, $yeahr) == true) {
            $lastDayOfMonth = new DateTime();
            $lastDayOfMonth->setDate($yeahr, $month, 28);
            $lastDayOfMonth = date('Y-m-d',
                $lastDayOfMonth->getTimestamp());
        }
        if (checkdate($month, 29, $yeahr) == true) {
            $lastDayOfMonth = new DateTime();
            $lastDayOfMonth->setDate($yeahr, $month, 29);
            $lastDayOfMonth = date('Y-m-d',
                $lastDayOfMonth->getTimestamp());
        }
        if (checkdate($month, 30, $yeahr) == true) {
            $lastDayOfMonth = new DateTime();
            $lastDayOfMonth->setDate($yeahr, $month, 30);
            $lastDayOfMonth = date('Y-m-d',
                $lastDayOfMonth->getTimestamp());
        }
        if (checkdate($month, 31, $yeahr) == true) {
            $lastDayOfMonth = new DateTime();
            $lastDayOfMonth->setDate($yeahr, $month, 31);
            $lastDayOfMonth = date('Y-m-d',
                $lastDayOfMonth->getTimestamp());
        }
        try {

            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare
            ('SELECT 
                        recorddate
                    FROM recordbook.record 
                    WHERE record.recorddate <= "' . $lastDayOfMonth . '"
                    
            ');

            $sth->execute();
            $record = $sth->fetchAll(PDO::FETCH_ASSOC);

            $this->dbc->commit();

        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }
        return $record;

    }

    public function readRecordDay($yeahr, $month, $day){

        $this->getConnection();

        $recorDayBeginn = new DateTime();
        $recorDayBeginn->setDate($yeahr, $month, $day);
        $recorDayBeginn->setTime(00,00,00);
        $queryDayBeginn = $recorDayBeginn->format('Y-m-d H:i:s');



        $recorddayEnd = new DateTime();
        $recorddayEnd->setDate($yeahr, $month, $day);
        $recorddayEnd->setTime(24,60,60);
        $queryDayEnd = $recorddayEnd->format('Y-m-d H:i:s');


        try{
            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare
            ('SELECT
                        status,
                        place,
                        record,
                        comment
                    FROM record WHERE recorddate >= "' . $queryDayBeginn . '" AND recorddate <= "' . $queryDayEnd .'"
                    ');

            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $exception){
            $this->dbc->rollBack();
            echo ('[Error] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }
        return $result;
    }

    public function writeRecordDay()
    {
        $this->getConnection();

        try{

            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare('INSERT INTO recordday(place, status, record, attachment) VALUES ()');
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('Failed: ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }

        return true;

    }

    public function createRecordMonth($month, $year)
    {
        $this->getConnection();
        try {
            $this->dbc->beginTransaktion();
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('Failed: ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }

        return true;
    }

    public function startSession() {

        if (isset($_REQUEST['PHPSESSID']) || isset($_SESSION['session_id'])) {
//            var_dump($_REQUEST, ' folgt die session', $_SESSION, 'session name', session_name());
            if (isset($_REQUEST['PHPSESSID'])) {
                $session_id = array($_REQUEST['PHPSESSID']);
            } elseif (isset($_SESSION['session_id'])) {
                $session_id = array($_SESSION['session_id']);
            }
            session_start($session_id);
        } else {
            session_start();
            header('location: /index.php');
        }
        $_SESSION['session_id'] = $_REQUEST['PHPSESSID'];
    }
}