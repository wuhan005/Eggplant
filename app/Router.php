<?php

// Set your router here.
// The HTTP method name must be upper.

$router404 = 'Main/NotFound';   // 404 router
$router[''] = 'Main';           // Default router

$router['User']['POST'] = 'User/Register';
$router['User/Login']['POST'] = 'User/Login';

