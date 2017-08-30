<?php

class DB_Connection extends PDO
{

//    Variablen der Klasse
    protected $host = 'dedi3098.your-server.de';
    protected $user = 'frankb_7';
    protected $password = 'eB7NBTH1Xkt7Tamc';
    protected $options = array('db_name' => 'recordbook'/*,
                                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION*/);
    public $dbc = NULL;


//    Getter und Setter

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return bool|null|\PDO|string
     */
    public function getDbc()
    {
        return $this->dbc;
    }

    /**
     * @param bool|null|\PDO|string $dbc
     */
    public function setDbc($dbc)
    {
        $this->dbc = $dbc;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }


//Konstruktor
    public function __construct()
    {
        $this->dbc = $this->getConnection();
        if (is_a($this->dbc, 'PDO')) {
            return $this->dbc;
        }
    }

//    gives an active pdo object back, if none exists will be one create
    public function getConnection()
    {
        if (!isset($this->dbc) || $this->dbc === NULL) {
            $this->dbc = $this->createConnection();
            if ($this->dbc === false || $this->dbc === NULL) {
                return 'please try again later';
            }
        }
        if (isset($this->dbc) && is_a($this->dbc, get_parent_class($this))) {
            return $this->dbc;
        }
    }




    public function createConnection(){
        try {
            if (isset($this->dbc)) {
                return $this->dbc;
            } elseif ($this->dbc === NULL || !isset($this->dbc)) {
                $this->dbc = new PDO('mysql:dbname='.$this->options['db_name'].';host='.$this->host, $this->user, $this->password);
                return $this->dbc;
            }

        }
        catch (PDOException $e){
            die($e->getMessage());
        }

        return false;

    }
}