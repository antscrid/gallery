<?php
class Form
{
    /** Validate upload form field values
     *
     * @param $data
     * @return array|bool
     */
    public function imgValidation($data)
    {
        $errors = array();
        if (empty($data['authorname']) || strlen($data['authorname']) > 40) {
            $errors[] = 'Enter author up to 40 symbols';
        }
        if (empty($data['description']) || strlen($data['description']) > 255) {
            $errors[] = 'Enter description up to 255 symbols';
        }
        if (empty($_FILES)) {
            $errors[] = 'Your forgot to upload the image';
        }
        if (!in_array(getimagesize($_FILES['image']['tmp_name'])['mime'], ['image/jpeg', 'image/png', 'image/gif'])) {
            $errors[] = 'The gallery supports only the JPEG, PNG and GIF images';
        }
        if (!empty($errors)) {
            $_SESSION['fields'] = $data;
            $_SESSION['errors'] = $errors;
            return false;
        } else {
            return true;
        }
    }
    /** Validate login form field values
     *
     * @param $data
     * @return array|bool
     */
    public function loginValidation($data)
    {
        $errors = array();
        if (empty($data['login'])) {
            $errors[] = 'Login shouldn\'t be empty';
        }
        if (empty($data['pass'])) {
            $errors[] = 'Password shouldn\'t be empty';
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['fields'] = $data;
            return false;
        } else {
            return true;
        }
    }
    //signup form validation
    public function signupValidation($data)
    {
        $errors = array();
        if (empty($data['login'])) {
            $errors[] = 'Enter your login';
        }
        if (empty($data['pass']) || empty($data['repass'])) {
            $errors[] = 'Enter your password';
        }
        if ($data['pass'] != $data['repass']) {
            $errors[] = 'Check the passwords to be equal';
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['fields'] = $data;
            return false;
        } else {
            return true;
        }
    }
}