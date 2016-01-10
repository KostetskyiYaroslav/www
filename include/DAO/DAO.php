<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 04.01.2016
 * Time: 19:26
 */

namespace DAO;

class DAO
{
    /**
     * @var $_instance
     */
    protected static $_instance;

    private $_server = "localhost";
    private $_user = "root";
    private $_psswd = "1111";

    /**
     * Name of DB
     */
    private $_database = "TUTORIALS";

    /**
     * DAO constructor.
     */
    private function __construct(){

        $this->connection = new \mysqli($this->_server,
                                        $this->_user,
                                        $this->_psswd)
                                            or
                            die( "ERROR: Can't create connection:"
                                . mysqli_connect_error() );

        $this->connection->select_db($this->_database)
                                                         or
        die ( "ERROR: Can't connect to '$this->_database' !"
            . $this->connection->error );

        $this->connection->query ( 'SET names "utf8"' );

    }

    /**
     * @return DAO, Singleton
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __clone()
    {// protect exemplar from clone
    }

    private function __wakeup()
    {// protect exemplar from wakeup
    }
};
