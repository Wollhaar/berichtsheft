<?php


class DB_User
{

    private $dbc;



    public function __construct()
    {
        /*if (isset(\model\DB_Manager\DB_Connection::host)) {
            echo \model\DB_Manager\DB_Connection::host;*/
    }


    public function login($user, $password) {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();
        }

        $pw = sha1($password, true);
        $sql = 'SELECT username, password FROM User WHERE username = ?';
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute(array($user));
        $data = $stmt->fetch();
//        var_dump($data);

        if ($data['password'] == $pw) {
            return array('data' => $data, 'post' => array('username' => $user, 'pw' => $pw));
        }
        else {
            return 'password false';
        }
    }

    public function checkLogin($check) {
        if ($check['data']['username'] == $check['post']['username'] && $check['data']['password'] == $check['post']['pw']) {
            return TRUE;
        }
        var_dump($check);
        return array('Access denied');
    }

    /**
     * @param $user
     * @return mixed
     */
    public function registUser($user) {
        $this->dbc = new DB_Connection();
        if (isset($this->dbc) || is_a($this->dbc, 'PDO')) {
            $this->dbc = $this->dbc->getConnection();
        }

        $pw = sha1($user['password'], true);
        $sql = 'INSERT INTO User (username, password, email, first_name, last_name, adress, PLZ, place, birthday)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute(array($user['username'], $pw, $user['email'], $user['first_name'], $user['last_name'],
                            $user['adress'], $user['PLZ'], $user['place'], $user['birthday']));

//        var_dump($this->dbc);
        $sql = 'SELECT * FROM User WHERE username = "'.$user['username'].'"';
        $stmt = $this->dbc->query($sql);
        $fb = $stmt->fetch();
//        var_dump($fb);

        if($fb['username'] == $user['username']) {
            $fb['check'] = true;
            return $fb;
        } else
        {
            $fb['check'] = false;
            return $fb;
        }
    }
}