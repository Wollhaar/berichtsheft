<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Resources/PHP/model/DBManager/DB_Connection.php');

class DB_Instructor extends DB_Connection
{

    public function getInstructor()
    {
        $this->getConnection();

        try {
            $this->dbc->beginTransaction();
            $sql = $this->dbc->prepare('SELECT name, vorname, role, location, imgPath FROM recordbook.instructor');

            $sql->execute();
            $record = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $record;

            $this->dbc->commit();
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
            return false;
        }

        return true;
    }

    public function resetTable()
    {
        $this->getConnection();

        try {
            $sql = $this->dbc->prepare('DROP TABLE IF EXISTS instructor');
            $sql->execute();

            $sql = $this->dbc->prepare('CREATE TABLE instructor
                            (instructor_id INT NOT NULL AUTO_INCREMENT,
                            name VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci,
                            vorname VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci,
                            location VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci,
                            role VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci,
                            imgPath VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci,
                            content LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci,
                            PRIMARY KEY (instructor_id)
                            )');
            $sql->execute();
            $this->dbc->commit();
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
        }
    }

    public function setInstructor($nam, $vor, $loc, $rol, $img, $cont)
    {
        $this->getConnection();

        try {
            $this->dbc->beginTransaction();

            $sql = $this->dbc->prepare('INSERT INTO instructor (name, vorname, location, role, imgPath, content) VALUES (?,?,?,?,?,?)');
            $sql->bindParam(1, $nam, PDO::PARAM_STR);
            $sql->bindParam(2, $vor, PDO::PARAM_STR);
            $sql->bindParam(3, $loc, PDO::PARAM_STR);
            $sql->bindParam(4, $rol, PDO::PARAM_STR);
            $sql->bindParam(5, $img, PDO::PARAM_STR);
            $sql->bindParam(6, $cont, PDO::PARAM_STR);
            $sql->execute();

            $this->dbc->commit();
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
        }
    }

    public function updateInstructor(array $upd, $instId)
    {


        $updateElemts = "";
        foreach ($upd as $key => $value) {
            if ($key == 'name' && $value != null) {
                $updateElemts .= $key . '=' . "'" . $value . "'";
            }

            if ($key == 'vorname' && $value != null) {
                $updateElemts .= $key . '=' . "'" . $value . "'";
            }

            if ($key == 'location' && $value != null) {
                $updateElemts .= $key . '=' . "'" . $value . "'";
            }

            if ($key == 'role' && $value != null) {
                $updateElemts .= $key . '=' . "'" . $value . "'";
            }

            if ($key == 'imgPath' && $value != null) {
                $updateElemts .= $key . '=' . "'" . $value . "'";
            }

            if ($key == 'content' && $value != null) {
                $updateElemts .= $key . '=' . "'" . $value . "'";
            }
            if (isset($updateElemts)) {
                $updateElemts .= ', ';
            }
        }

        if (substr($updateElemts, strlen($updateElemts) - 2, 2) == ', ') {
            $updateElemts = substr($updateElemts, 0, strlen($updateElemts) - 2);
        }

        $updateElemts .= ' WHERE instructor_id = ' . $instId;
        $this->getConnection();

        try {
            $this->dbc->beginTransaction();

            $sql = $this->dbc->prepare('UPDATE instructor SET ' . $updateElemts);
            $sql->execute();

            $this->dbc->commit();
        } catch (PDOException $exception) {
            $this->dbc->rollBack();
            echo('[Error ] ' . $exception->getMessage() . 'in Line: ' . $exception->getLine());
        }
    }
}
