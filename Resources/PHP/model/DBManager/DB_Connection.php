<?php


class DB_Connection extends PDO
{
    protected $host = 'localhost';

    protected $user = 'davidz_5';

    protected $password = 'FB9a1Kbxdpe99vCC';

    protected $options = array('db_name' => 'davidz_report');

    private $dbc = NULL;

    public function __construct()
    {
        $this->dbc = $this->getConnection();
        if (is_a($this->dbc, 'PDO')) {
            return $this->dbc;
        }
    }

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
        catch (Exception $e){
            die($e->getMessage());
        }

        return false;

    }
}