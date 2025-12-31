<?php

class Profile extends UserHandler
{

    public function changeName($column_name, $userid, $data)
    {
        $this->sanitizeInput($data);
        $this->editColumn($column_name, $data, $userid);
    }
    public function changeEmail($column_name, $userid, $data)
    {
        $this->sanitizeInput($data);
        $user = $this->getUserByEmail($data);
        if (!$user) {
            $this->editColumn($column_name, $data, $userid);
            return true;
        } else {
            return false;
        }
    }
    public function changePassword($column_name, $userid, $current_password, $new_password)
    {
        $this->sanitizeInput($current_password);
        $this->sanitizeInput($new_password);
        $user = $this->getUserByID($userid);

        if ($user && password_verify($current_password, $user['password'])) {
            $this->editColumn($column_name, $this->hashPassword($new_password), $userid);
            return true;
        } else {
            return false;
        }
    }
}
