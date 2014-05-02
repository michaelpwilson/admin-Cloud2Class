<?php
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var string The user's name
     */
    private $user_name = "";
    /**
     * @var string The user's mail
     */
    private $user_email = "";
    /**
     * @var string The user's password hash
     */
    private $user_password_hash = "";
    /**
     * @var boolean The user's login status
     */
    private $user_is_logged_in = false;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    public function __construct()
    {

        // create/read session
        session_start();

        // if user tried to log out
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // if user has an active session on the server
        elseif (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)) {
            $this->loginWithSessionData();
        }
        // if user just submitted a login form
        elseif (isset($_POST["login"])) {
            $this->loginWithPostData();
        }
    }

    /**
     * log in with session data
     */
    private function loginWithSessionData()
    {
        // set logged in status to true, because we just checked for this:
        // !empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)
        // when we called this method (in the constructor)
        $this->user_is_logged_in = true;
    }

    /**
     * log in with post data
     */
    private function loginWithPostData()
    {
        // if POST data (from login form) contains non-empty user_name and non-empty user_password
        if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff
                $this->user_name = $this->db_connection->real_escape_string($_POST['user_name']);
                // database query, getting all the info of the selected user
                $checklogin = $this->db_connection->query("SELECT user_login, user_forename, user_password FROM user WHERE user_login = '" . $this->user_name . "';");

                // if this user exists
                if ($checklogin->num_rows == 1) {

                    // get result row (as an object)
                    $result_row = $checklogin->fetch_object();

                    // using PHP 5.5's password_verify() function to check if the provided passwords fits to the hash of that user's password
                    if (password_verify($_POST['user_password'], $result_row->user_password)) {

                        // write user data into PHP SESSION [a file on your server]
                        $_SESSION['user_name'] = $result_row->user_login;
                        $_SESSION['user_email'] = $result_row->user_forename;
                        $_SESSION['user_logged_in'] = 1;

                        // set the login status to true
                        $this->user_is_logged_in = true;

                    } else {
                        $this->errors[] = '<div><div class="alert alert-success alert-dismissable">Wrong password. Try again.</div></div>';
                    }
                } else {
                    $this->errors[] = '<div><div class="alert alert-danger alert-dismissable">This user does not exist.</div></div>';
                }
            } else {
                $this->errors[] = '<div ><div class="alert alert-danger alert-dismissable">Database connection problem.</diV></div>';
            }
        } elseif (empty($_POST['user_name'])) {
            $this->errors[] = '<div><div class="alert alert-danger alert-dismissable">Username field was empty.</div></div>';
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = '<div><div class="alert alert-danger alert-dismissable">Password field was empty.</div></div>';
        }
    }
    /**
     * perform the logout
     */
    public function doLogout()
    {
        $_SESSION = array();
        session_destroy();
        $this->user_is_logged_in = false;
        $this->messages[] = '<div><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>You have been logged out.</div></div>';

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        return $this->user_is_logged_in;
    }
}
