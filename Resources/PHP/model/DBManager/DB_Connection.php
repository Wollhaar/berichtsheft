<?php

class DB_Connection extends PDO
{
    protected $host = 'dedi3098.your-server.de';

    protected $user = 'frankb_7';

    protected $password = 'eB7NBTH1Xkt7Tamc';

    protected $options = array('db_name' => 'recordbook'/*,
                                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION*/);



    public $dbc = NULL;

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