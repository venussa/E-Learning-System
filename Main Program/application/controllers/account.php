<?php

/**
 * account Class
 *
 * Controller for manage user login
 *
 * @category	controller
 * @package		controllers
 * @uses 		models/account
 */

class account extends load{

	// --------------------------------------------------------------------

    /**
     * Default HTTP Request Page
     *
     * @return string
     */

	public function home(){

		header("location:".HomeUrl()."/account/login");

	}

	// --------------------------------------------------------------------

    /**
     * Login HTTP Request Page
     *
     * @return string
     */

	public function login(){

		$this->view(["header","account/login","footer"]);
	}

	// --------------------------------------------------------------------

    /**
     * Forgot Password HTTP Request Page
     *
     * @return string
     */

	public function forgot(){

		$this->view(["header","account/forgot","footer"]);
	}

	// --------------------------------------------------------------------

    /**
     * Reset Password HTTP Request Page
     *
     * @return string
     */


	public function reset(){

		$this->view(["header","account/reset","footer"]);

	}
}