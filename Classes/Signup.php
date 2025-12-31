<?php
require_once 'Dbh.php';
class Signup extends UserHandler
{
    // Construct function takes in the form data and sanitizes the data from any malicious input.
    // Then calls the validateInput() to ensure the data is correct and not empty.
    // Then calls the getUserEmail() to check if the account with that email already exists.
    public function __construct($first_name, $last_name, $email, $password, $reenter_password)
    {
        $this->first_name = $this->sanitizeInput($first_name);
        $this->last_name =  $this->sanitizeInput($last_name);
        $this->email =  $this->sanitizeInput($email);
        $this->password =  $this->sanitizeInput($password);
        $this->reenter_password = $this->sanitizeInput($reenter_password);
        $this->user = $this->getUserByEmail($this->sanitizeInput($email));
    }

    // Function to validate all input to ensure everything is entered correctly and theres no empty input.
    private function validateInput()
    {
        if (empty($this->first_name)) {
            $this->form_messages["first_name"] = "First name is required.";
        }

        if (empty($this->last_name)) {
            $this->form_messages["last_name"] = "Last name is required.";
        }

        if (empty($this->email)) {
            $this->form_messages["email"] = "Email is required.";
        }

        if (empty($this->password)) {
            $this->form_messages["password"] = "Password is required.";
        }

        if (empty($this->reenter_password)) {
            $this->form_messages["reenter_password"] = "Password is required.";
        }

        if (!empty($this->password) && !empty($this->reenter_password) && ($this->password != $this->reenter_password)) {
            $this->form_messages["password_match"] = "Passwords do not match!";
        }

        if ($this->user !== false) {
            $this->form_messages["email_exists"] = "Email already exists.";
        }
    }


    // Function to insert the user into the MySQL database.
    private function insertUser()
    {
        // Hash the password
        $password_hash = $this->hashPassword($this->password);

        $query = "INSERT INTO users (first_name, last_name, email, password, role, status)
                  VALUES(:first_name, :last_name, :email, :password_hash, :role, :status);";

        // Use stmt's to prevent SQL injection. This is for security purposes and prevents anything malicious.
        // Connect to the database and prepare the query above.
        // Set each piece of data to their corresponding placeholder.
        // Then excute the stmt.
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password_hash", $password_hash);
        $stmt->bindValue(":role", 'customer');
        $stmt->bindValue(":status", 'active');
        $stmt->execute();
    }

    // Function to create the user.
    // First validates the input and then checks if there is any errors. 
    // If there is no errors then the user is inserted into the DB.
    public function createUser()
    {
        $this->validateInput();

        if (!empty($this->form_messages)) {
            return;
        }

        $this->insertUser();
    }
}
