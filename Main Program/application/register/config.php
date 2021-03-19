<?php

/*
 *---------------------------------------------------------------
 * SET CONTROLLER NAME
 *---------------------------------------------------------------
 *
 * only registered controllers can be executed
 * the file will be stored in the application / controller folder
 * Example (new controller)->declarate_space(["controller1","controller2","controller3"]);
 * The data strored is array
 * if you want to rewrite all document as default page, you can using default configuration
 * Example (new controller)->declarate_space(["controller1","controller2","controller3"],true);
 * after taht, youcan create defaut.php file in /application/controller/default.php
 */

(new controller)->declarate_space([
	"account",
	"setting",
	"teacher",
	"student",
	"faculty",
	"activity",
	"courses",
	"profile",
	"my_courses",
	"my_grade"
]);