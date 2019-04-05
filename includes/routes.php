<?php

    // --- Routes --- //

    // Define routes
    $route["/"] = array("controller" => "IndexController", "uniqueName" => "index");
    $route["/index"] = array("controller" => "IndexController", "uniqueName" => "index");
    $route["/index.html"] = array("controller" => "IndexController", "uniqueName" => "index");

    // Login
    $route["/login"] = array("controller" => "LoginController", "uniqueName" => "login");
    $route["/login.html"] = array("controller" => "LoginController", "uniqueName" => "login");

    //Register
    $route["/register"] = array("controller" => "RegisterController", "uniqueName" => "register");
    $route["/register.html"] = array("controller" => "RegisterController", "uniqueName" => "register");

?>