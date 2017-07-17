<?php
require_once('DB_Connection.php');

class DB_Record
{

    private $dbc;

    public function getConnection()
    {
        $this->dbc = new DB_Connection();;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();
        }
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
            $sth = $this->dbc->prepare('CREATE DATABASE IF NOT EXISTS recordbook');
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
            echo '[Error] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine();
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

    public function readRecordDay($yeahr, $month, $day)
    {

        $this->getConnection();

        $recorDayBeginn = new DateTime();
        $recorDayBeginn->setDate($yeahr, $month, $day);
        $recorDayBeginn->setTime(00, 00, 00);
        $queryDayBeginn = $recorDayBeginn->format('Y-m-d H:i:s');

        $recorddayEnd = new DateTime();
        $recorddayEnd->setDate($yeahr, $month, $day);
        $recorddayEnd->setTime(24, 60, 60);
        $queryDayEnd = $recorddayEnd->format('Y-m-d H:i:s');

        try {
            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare
            ('SELECT
                        status,
                        place,
                        record,
                        comment
                    FROM record WHERE recorddate >= "' . $queryDayBeginn . '" AND recorddate <= "' . $queryDayEnd . '"
                    ');

            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }
        return $result;
    }



// getting all records from one user
    public function recordOut($user, $operator = 'forward')
    {

//  SET  @start = 1, @finish = 10;
//        SELECT @start := 1, @finish := 10;

        $this->dbc = new DB_Connection();
        $output = null;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('SELECT user_id FROM User WHERE username = ?');
                $sth->execute([$user]);
                $u_id = $sth->fetch();
//                echo $user.' = '.$u_id['user_id'];

                /*$sth = $this->dbc->prepare('SELECT MAX(record_id) AS last FROM record LEFT JOIN recordbook ON record.record_id = recordbook.record WHERE user = ?');
                $sth->execute($u_id['user_id']);
                $last = $sth->fetch(); */

                if (empty($_SESSION['counter']) || ($_SESSION['counter'] < 6)) {
                    $sql = 'SELECT count(record.record_id) AS counter FROM record 
                            LEFT JOIN recordbook ON record.record_id = recordbook.record 
                            WHERE user = ?';
                    $sth = $this->dbc->prepare($sql);
                    $sth->execute([$u_id['user_id']]);
                    $count = $sth->fetch();
                    $_SESSION['rows'] = $count['counter'];
                    $_SESSION['counter'] = $count['counter'];
//                    var_dump($_SESSION);
                }
                if ($operator == 'forward') {
                    $_SESSION['counter'] = ($_SESSION['counter']) - 5;
                } elseif ($operator == 'back') {
                    $_SESSION['counter'] = ($_SESSION['counter']) + 5;
                }

//echo $u_id['user_id'].'->'.$_SESSION['counter'];
                $sth = $this->dbc->prepare('SELECT record.record_id, status, place, record.record AS records, comment, recorddate 
                                                      FROM record LEFT JOIN recordbook ON record.record_id = recordbook.record 
                                                      WHERE user = ? LIMIT ?,5');
                $sth->bindParam(1, $u_id['user_id'], PDO::PARAM_INT);
                $sth->bindParam(2, $_SESSION['counter'], PDO::PARAM_INT);
                $sth->execute();
                // var_dump(   $sth->debugDumpParams());

                $output = $sth->fetchAll();
                //while($data=$sth->fetch()){var_dump($data);}
//var_dump($user, $u_id);
                /*  echo '<pre>';
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
    public function getRecord($id)
    {
        $this->dbc = new DB_Connection();
        $output = null;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $this->dbc->beginTransaction();
                $sth = $this->dbc->prepare('SELECT * FROM record WHERE record_id = ?');
                $sth->execute([$id]);
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
    public function saveRecord(
        $record,
        $comment = null,
        $id = null,
        $user = null
    ) {
        $this->dbc = new DB_Connection();
        $output = null;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                if (empty($id)) {
                    $this->dbc->beginTransaction();
                    // getting user
                    $sth = $this->dbc->prepare('SELECT user_id FROM User WHERE username = ?');
                    $sth->execute([$user]);
                    $u_id = $sth->fetch();

                    // setting records and parallel connection/relation with user
                    $sth = $this->dbc->prepare('INSERT INTO record (record, comment) VALUES (?, ?); 
                                                        INSERT INTO recordbook (record, user) VALUES (LAST_INSERT_ID(), ?)');
                    $sth->execute([$record, $comment, $u_id['user_id']]);
                } elseif (isset($id)) {
                    $this->dbc->beginTransaction();
                    $sth = $this->dbc->prepare('UPDATE record SET record = ?, comment = ? WHERE record_id = ?');
                    $sth->execute([$record, $comment, $id]);
                }
                $sth = $this->dbc->prepare('SELECT record FROM record WHERE record_id = ?');
                $sth->execute([$id]);
                $control = $sth->fetch();

//var_dump($id, ' id', $control);
                if ($control['record'] == $record) {
                    $output = true;
                } else {
                    $output = false;
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