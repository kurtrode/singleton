<?php
class Session{
    public static $singleton = null;
    public static function instance()
    {
if (static::$singleton === null){
// if singleton property of class is still null, no new object
static::$singleton = new static;
}
return static::$singleton;
    }
    //non static things
    public array $data = [];
    public array $old_request = [];
    public function __construct(){
// start session
session_start();
$this->data = $_SESSION;
//merge 'flashed data' into common data
$this->data = array_merge($this->data, $_SESSION['flashed_data']??[]);
//delete 'flashed data' from session
unset($_SESSION['flashed_data']);
//get previous request's data from session and store in object
$this->old_request = $_SESSION['flashed_request']??[];
//delete 'flashed request' from session
unset($_SESSION['flashed_request']);
    }
    //stores a value in the session
    public function set($key,$value){
        $this->data[$key]=$value;
        $_SESSION[$key]=$value;
    }
    public function get($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }
    public function flash($key,$value)
    {
        $_SESSION['flashed_data'][$key]=$value;
    }
    //flash entire post request to be accessed in following one
    public function flashRequest()
    {
        $_SESSION['flashed_request'] = $_POST;
    }
    //retrieves data from request's POST if it has been flashed
    public function old($key,$default = null)
    {
        return $this->old_request[$key] ?? $default;
    }
}