<?php
/**
 *  
 *  Description: PHP5 MySQL Database Class implementing the Singleton Design Pattern
 *  Author: Mahadev
 *  Date: 5-June-2018
 *  Version: 1
 */
class mydb {
    /**
     * The mydb database object
     * 
     * @access private
     * @var object
     */
    private $mydb;
     
    /**
     * MySQLi database object
     * 
     * @access private
     * @var object
     */
    private static $instance;
     
    /**
     * Current result set
     * 
     * @access private
     * @var object
     */
    private $result;
     
    /**
     * The last result (processed)
     * 
     * @access private
     * @var array
     */
    private $last_result;
     
    /**
     * The number of rows from last result
     * 
     * @access private
     * @var int
     */
    private $row_count;
     
    /**
     * Last error
     * 
     * @access private
     * @var string
     */
    private $last_error;
     
    /**
     * PHP5 Constructor
     * 
     * Making this function 'private' blocks this class from being directly created.
     * 
     * @access private
     */
    private function __construct() { }
     
    /**
     * Creates and references the mydb object.
     * 
     * @access public
     * @return object MySQLi database object
     */
    public static function instance() {
        if ( !self::$instance )
            self::$instance = new mydb();
        return self::$instance;
    }
     
    /**
     * Connect to the MySQL database.
     * 
     * @param string $host MySQL hostname
     * @param string $user MySQL username
     * @param string $password MySQL password
     * @param string $name MySQL database name
     * @return bool True if successful, false on error.
     */
    public function connect($host, $user, $password, $name) {
        // Connect to the database
        $this->mydb = new mysqli($host, $user, $password, $name);
        // Check connection
        if ( mysqli_connect_errno() ) {
            $this->last_error = mysqli_connect_error();
            return false;
        }
        return true;
    }
     
    /**
     * Checks for errors.
     * 
     * @return string|false $last_error if it exists or false if no errors.
     */
    public function is_error() {
        if ( isset($this->last_error) && !empty($this->last_error) )
            return $this->last_error;
        return false;
    }
     
    /**
     * Close active connection to MySQL database.
     * 
     * @access public
     * @return bool Always returns true.
     */
    public function close() {
        if ( $this->mydb )
            $this->mydb->close();
        return true;
    }
     
    /**
     * Executes query and returns results.
     * 
     * @access public
     * @param string $sql The SQL statement to execute.
     * @return mixed
     */
    public function query($sql) {
        $this->result = $this->mydb->query($sql);
        return $this->result;
    }
     
    public function get_results($sql) {
        if ( !$this->query($sql) )
            return false;
         
        $num_rows = 0;
        while ( $row = $this->result->fetch_object() ) {
            $this->last_result[$num_rows] = $row;
            $num_rows++;
        }
         
        $this->result->close();
         
        return $this->last_result;
    }
     
    /**
     * Retrieve a single row from the database.
     * 
     * Do not include LIMIT 1 on the end, as this will be taken care
     * of automatically.
     * 
     * @param string $sql The SQL statement to execute.
     * @return object The MySQL row object
     */
    public function get_row($sql) {
        if ( !$results = $this->query($sql . " LIMIT 1") )
            return false;
         
        return $results->fetch_object();
    }

    public function insert_row($sql) {
        $this->query($sql);
    }
     
    /**
     * Sanitizes data for safe execution in SQL query.
     * 
     * @access public
     * @param mixed $data The data to be escaped.
     * @return mixed
     */
    public function escape($data) {
        return $this->mydb->real_escape_string($data);
    }
     
    /**
     * Prevent cloning of mydb.
     * 
     * @access public
     * @return void
     */
    public function __clone() {
        // Issue E_USER_ERROR if clone is attempted
        trigger_error('Cloning <em>mydb</em> is prohibited.', E_USER_ERROR);
    }
     
    /**
     * Destructor
     * 
     * @access public
     */
    public function __destruct() {}
}
