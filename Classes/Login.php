<?php

// Once the data is passed and recieved in login.inc.php, the functions in the Login class are called.
// This is the login class that handles all of the login logic.
// The login class extends UserHandler to inherit the functions.


class Login extends UserHandler
{
    // Construct that runs when a new object for Login is created to get the form input and sanitize any of the data.
    public function __construct($email, $password)
    {
        $this->email =  $this->sanitizeInput($email);
        $this->password =  $this->sanitizeInput($password);
        $this->user = $this->getUserByEmail($email);
    }

    // Function to validate all input to ensure everything is entered correctly and theres no empty input.
    private function validateInput()
    {
        if (empty($this->email)) {
            $this->form_messages["email"] = "Email is required.";
        }

        if (empty($this->password)) {
            $this->form_messages["password"] = "Password is required.";
        }

        if ($this->user === false) {
            $this->form_messages["user_exists"] = "User does not exist. Signup now";
        }
    }

    // Main function to login the user and set any SESSION variables that we will need to use.
    // Catches any errors that were recieved from validateInput();
    public function loginUser()
    {
        $this->validateInput();
        if (!empty($this->form_messages)) {
            return;
        } else {
            if ($this->user !== false && password_verify($this->password, $this->user['password'])) {
                require_once '../config.php';
                $_SESSION["userid"] = $this->user["userid"];
                $_SESSION["first_name"] = $this->user["first_name"];
                $_SESSION["last_name"] = $this->user["last_name"];
                $_SESSION["email"] = $this->user["email"];
                $_SESSION["user_role"] = $this->user["role"];
                return true;
            } else {
                $this->form_messages["invalid_user"] = "Your email or password is incorrect";
                return false;
            }
        }
    }
}
