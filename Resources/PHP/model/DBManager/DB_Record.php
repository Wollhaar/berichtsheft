<?php
//require_once('DB_Connection.php');



class DB_Record
{

    private $dbc;



    public function getConnection(){
        $this->dbc =  new DB_Connection();;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();
            return $this->dbc;
        }
    }


    public function deleteDatabase()
    {
        $this->dbc = $this->getConnection();
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
        $this->dbc = $this->getConnection();

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
        var_dump($this->dbc);
        try {

//            $lastDayOfMonth = ;

            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare
            ('SELECT 
                        recorddate
                    FROM recordbook.record 
                    WHERE record.recorddate <= "' . 31 . '"
                    
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

// getting all records from one user
    public function recordOut($user, $operator = 'forward'){

//        $user = intval($user);

        $this->dbc = new DB_Connection();
        $output = NULL;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $this->dbc->beginTransaction();
/*                $sth = $this->dbc->prepare('SELECT user_id FROM User WHERE username = ?');
                $sth->execute(array($user));
                $u_id = $sth->fetch();*/
//                echo $user.' = '.$u_id['user_id'];

                /*$sth = $this->dbc->prepare('SELECT MAX(record_id) AS last FROM record LEFT JOIN recordbook ON record.record_id = recordbook.record WHERE user = ?');
                $sth->execute($u_id['user_id']);
                $last = $sth->fetch(); */



                if ( empty($_SESSION[$_SESSION['user']]['counter']) || ($_SESSION[$_SESSION['user']]['counter'] < 6 )) {
                    $sql = "SELECT count(record.record_id) AS counter FROM record 
                            LEFT JOIN recordbook ON record.record_id = recordbook.record 
                            WHERE recordbook.user = :user";
//                    $sth = $this->dbc->query($sql);
                    $sth = $this->dbc->prepare($sql);

                    $sth->bindParam(':user', $user, PDO::PARAM_INT);
                    $sth->execute();
                    $count = $sth->fetchAll(PDO::FETCH_ASSOC);

/*                    echo '<pre>';
                    var_dump($count);
                    echo '</pre>';*/

                    $_SESSION[$_SESSION['user']]['rows'] = $count[0]['counter'];
                    $_SESSION[$_SESSION['user']]['counter'] = $count[0]['counter'];
//                    var_dump($_SESSION);
                }



//echo '<br/>'.$user.'->'.$_SESSION[$_SESSION['user']]['counter'].' = '.$count[0]['counter'].'<br/>';
                $sth = $this->dbc->prepare('SELECT record.record_id, status, place, record.record AS records, comment, recorddate 
                                                      FROM record LEFT JOIN recordbook ON record.record_id = recordbook.record 
                                                      WHERE user = ? LIMIT ?,5');
                $sth->bindParam(1, $user, PDO::PARAM_STR);
                $sth->bindParam(2, $_SESSION[$_SESSION['user']]['counter'], PDO::PARAM_INT);
                $sth->execute();
              // var_dump(   $sth->debugDumpParams());

                $output = $sth->fetchAll(PDO::FETCH_ASSOC);
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


//    getting called over AJAX
    public function gettingRecords($user, $operator) {

        $this->dbc = new DB_Connection();
        $output = NULL;
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $this->dbc->beginTransaction();

                if ($operator == 'forward') {
                    $_SESSION[$_SESSION['user']]['counter'] = $_SESSION[$_SESSION['user']]['counter'] - 5;
                }
                elseif ($operator == 'back') {
                    $_SESSION[$_SESSION['user']]['counter'] = $_SESSION[$_SESSION['user']]['counter'] + 5;
                }

                echo '<br/>'.$user.'->'.$_SESSION[$_SESSION['user']]['counter'];

                $sth = $this->dbc->prepare('SELECT record.record_id, status, place, record.record AS records, 
                                                      comment, recorddate FROM record LEFT JOIN recordbook 
                                                      ON record.record_id = recordbook.record WHERE user = ? LIMIT ?,5');
                $sth->bindParam(1, $user, PDO::PARAM_STR);
                $sth->bindParam(2, $_SESSION[$_SESSION['user']]['counter'], PDO::PARAM_INT);
                $sth->execute();
                // var_dump(   $sth->debugDumpParams());

                $output = $sth->fetchAll(PDO::FETCH_ASSOC);
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
        $this->dbc = $this->dbc->getConnection();
        $output = NULL;

//        only if connection is pdo start the sql-script
        if (is_a($this->dbc, 'PDO')) {

            try {
//              when $id got not transmitted, then a new record has to be created
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
//                when id is got through post set, then update record
                elseif (isset($id)) {
                    $this->dbc->beginTransaction();

                    $last_update = time();
                    $sth = $this->dbc->prepare('UPDATE record SET record = ?, comment = ?, last_update = ? WHERE record_id = ?');
                    $sth->execute(array($record, $comment, $id, $last_update));
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


//    get last users record
    public function lastRecord($user) {
        $this->dbc = new DB_Connection();
        $output = NULL;
        if (isset($this->dbc) || is_a($this->dbc, 'DB_Connection')) {
            $this->dbc = $this->dbc->getConnection();

            try {
                $this->dbc->beginTransaction();

                $sth = $this->dbc->prepare('SELECT record_id, recorddate FROM record 
                                                      WHERE record_id = (SELECT max(recordbook.record) 
                                                      FROM recordbook WHERE user = :user)');

                $sth->bindParam(':user', $user, PDO::PARAM_STR);
                $sth->execute();

//                    $sth->debugDumpParams();

                $output = $sth->fetch(PDO::FETCH_ASSOC);
                }
                catch (PDOException $exception) {
                    print('Failed: ' . $exception->getMessage());
                }
            }
        return $output;
    }



    public function getDate(){
//        only date of record
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