<?php

class UserHandler extends Dbh
{

    protected $first_name;
    protected $last_name;
    protected $email;
    protected $password;
    protected $reenter_password;
    protected $password_hash;
    protected $role;
    protected $form_messages = [];
    protected $user;

    // Removes any malicious scripts or anything that could be a security threat.
    protected function sanitizeInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Function to query the DB and get the user information based on the entered email. 
    // Emails are unique so there will only ever be one row for a user in the DB.
    protected function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Function to query the DB and get the user information based on the userid
    // Userids are the primary key so there will only ever be one row for a user in the DB.
    protected function getUserByID($userid)
    {
        $query = "SELECT * FROM users WHERE userid = :userid";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":userid", $userid);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    // Function to edit a column based on the column name, data, and userid.
    public function editColumn($column_name, $data, $userid)
    {
        $query = "UPDATE users SET $column_name = :data WHERE userid = :userid";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":userid", $userid);
        $stmt->execute();
    }

    // Function to return errors.
    public function getFormMessage()
    {
        return $this->form_messages;
    }
}
