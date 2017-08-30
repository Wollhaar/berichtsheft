<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

include_once($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/classes/models/DBManager/DB_Connection.php');

class DB_Instructor extends DB_Connection
{

    private $school;
    private $extern;
    private $enterprise;

    /**
     * @return mixed
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @param mixed $school
     */
    public function setSchool($school)
    {
        $this->school = $school;
    }

    /**
     * @return mixed
     */
    public function getExtern()
    {
        return $this->extern;
    }

    /**
     * @param mixed $extern
     */
    public function setExtern($extern)
    {
        $this->extern = $extern;
    }

    /**
     * @return mixed
     */
    public function getEnterprise()
    {
        return $this->enterprise;
    }

    /**
     * @param mixed $enterprise
     */
    public function setEnterprise($enterprise)
    {
        $this->enterprise = $enterprise;
    }

    public function __construct(){
        $this->getInstructor('Betrieb');
        $this->getInstructor('Extern');
        $this->getInstructor('Schule');

    }

    public function getInstructor($location)
    {
        $this->getConnection();

        try {
            $this->dbc->beginTransaction();
//            $sth = $this->dbc->prepare('SELECT instructor_id, name, vorname, role, location, imgPath, content FROM recordbook.instructor');

            $sth = $this->dbc->prepare('SELECT 
                                              instructor_id, 
                                              name, vorname, 
                                              role, 
                                              location, 
                                              imgPath, 
                                              content 
                                              FROM recordbook.instructor WHERE location=?');

            $sth->bindParam(1, $location, PDO::PARAM_STR);

            $sth->execute();
            switch ($location){
                case 'Betrieb':{
                    $this->setEnterprise($sth->fetchAll(PDO::FETCH_ASSOC));
                    break;
                }
                case 'Schule':{
                    $this->setSchool($sth->fetchAll(PDO::FETCH_ASSOC));
                    break;
                }
                case 'Extern':{
                    $this->setExtern($sth->fetchAll(PDO::FETCH_ASSOC));
                    break;
                }
                default:{
                    echo "Fehler bei paramterübergabe in getInstructor() funktion";
                    return false;

                }
            }

//            $record = $sth->fetchAll(PDO::FETCH_ASSOC);

//            return $record;
            $this->dbc->commit();
            $this->dbc = NULL;
            return true;


//
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }

        return true;
    }

    public function getSingleInstructor($single_id)
    {
        $this->getConnection();

        try {
            $this->dbc->beginTransaction();
            $sth = $this->dbc->prepare(
                'SELECT  name, vorname, role, location, imgPath, content FROM recordbook.instructor WHERE instructor_id = ?');

            $sth->bindParam(1, $single_id, PDO::PARAM_INT);
            $sth->execute();

            $record = $sth->fetchAll(PDO::FETCH_ASSOC);

            $this->dbc->commit();

            return $record;
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }
    }

    public function writeInstructor(
        $name,
        $vorname = null,
        $location = null,
        $role = null,
        $content = null
    ) {
        $this->getConnection();

        if (isset($name) == false) {
            echo '[Error] Kein Name gestetzt';
            return false;
        }

        try {
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
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }
    }

//updateInstructor ist noch Fehlerhaft da nicht berücksichtigt wird das vorhandene einträge die nicht überschrieben werden sollen
//mit Null überschrieben werden

    public function updateInstructor(
        $instructor_id,
        $name = null,
        $vorname = null,
        $location = null,
        $role = null,
        $imgPath = null,
        $content = null
    ) {
        $this->getConnection();

        try {
            $this->dbc->beginTransaction();

            $sth = $this->dbc->prepare("UPDATE instructor SET name=?, vorname=?, location=?, role=?, imgPath=?, content=? WHERE instructor_id=?");

            $sth->bindParam(1, $name, PDO::PARAM_STR);
            $sth->bindParam(2, $vorname, PDO::PARAM_STR);
            $sth->bindParam(3, $location, PDO::PARAM_STR);
            $sth->bindParam(4, $role, PDO::PARAM_STR);
            $sth->bindParam(5, $imgPath, PDO::PARAM_STR);
            $sth->bindParam(6, $content, PDO::PARAM_STR);
            $sth->bindParam(7, $instructor_id, PDO::PARAM_INT);

            $sth->execute();
            $this->dbc->commit();

            return true;
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }
    }
}
