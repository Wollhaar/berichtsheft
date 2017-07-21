<?php

class DB_User
{

    private $dbc;

    public function __construct()
    {
        /*if (isset(\model\DB_Manager\DB_Connection::host)) {
            echo \model\DB_Manager\DB_Connection::host;*/
    }

    public function login($user, $password)
    {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();
        }

        $pw = sha1($password, true);
        $sql = 'SELECT * FROM User WHERE username = ?';
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute([$user]);
        $data = $stmt->fetch();
//        var_dump($data);

        if ($data['password'] == $pw) {
            return [
                'data' => $data,
                'post' => ['username' => $user, 'pw' => $pw],
            ];
        } else {
            return 'password false';
        }
    }

    public function checkLogin($check)
    {
        if ($check['data']['username'] == $check['post']['username'] && $check['data']['password'] == $check['post']['pw']) {
            return true;
        }
//        var_dump($check);
        return ['Access denied'];
    }

    /**
     * @param $user
     * @return mixed
     */
    public function registUser($user)
    {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();
        }

        $pw = sha1($user['password'], true);
        $sql = 'INSERT INTO User (username, password, email, first_name, last_name, adress, PLZ, place, birthday)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute([
            $user['username'],
            $pw,
            $user['email'],
            $user['first_name'],
            $user['last_name'],
            $user['adress'],
            $user['PLZ'],
            $user['place'],
            $user['birthday'],
        ]);

//      var_dump($this->dbc);
        $sql = 'SELECT * FROM User WHERE username = "' . $user['username'] . '"';
        $stmt = $this->dbc->query($sql);
        $fb = $stmt->fetch(PDO::FETCH_ASSOC);
//      var_dump($fb);

        //--------------> Einschub anlegen des Profil Ordners <-----------------

        $this->loginProfile($fb['username'], $fb['password']);

        //----------------------------------------------------------------------

        if ($fb['username'] == $user['username']) {
            $fb['check'] = true;
            return $fb;
        } else {
            $fb['check'] = false;
            return $fb;
        }
    }

    public function loginProfile($user, $pass)
    {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();
        }

        $sql = 'SELECT username, user_id, password FROM User WHERE username = ?';
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute([$user]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $pw = sha1($pass, true);
        if ($data['password'] == $pw) {

            $pathname = "Resources/Profiles/" . $data['username'] . $data['user_id'];
            $mode = 755; //Besitzer alle Rechte / Gruppe und ander ausführrechte
            $recursive = false;

            if (is_dir($pathname) == false) {
                mkdir($pathname, octdec($mode), $recursive);
                return true;
            } else {
                echo 'Folder already exists';
                return false;
            }
        }
    }

}