<?php
//helper functions
require_once 'Session.php';
//alias for ->old() method of Session
function old($key,$default = null)
{
    return Session::instance()->old($key,$default);
}
function session()
{
    return Session::instance();
}
