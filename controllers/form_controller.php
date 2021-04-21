<?php
class FormController
{

    public static function ctrSignUp()
    {
        if (isset($_POST['sign'])) {
            $table = "users";
            $data = array(
                "user" => $_POST['u_user_s'],
                "name" => $_POST['u_fname_s'],
                "password" => md5($_POST['u_password_s'])
            );

            $response = FormsModel::mdlSignIn($table, $data);

            return $response;
        }
    }

    public static function ctrLogIn()
    {
        if (isset($_POST['log'])) {
            $table = "users";
            $data = array(
                "user" => $_POST['u_name'],
                "password" => md5($_POST['u_password'])
            );

            $response = FormsModel::mdlLogIn($table, $data);
            if (is_array($response)) {
                $_SESSION['logged'] = true;
                return true;
            }

            return false;
        }
    }

    public static function ctrSelectUsers()
    {
        $table = "users";
        $response = FormsModel::mdlSelectAll($table);

        return $response;
    }

    public static function ctrUpdateUser()
    {
        $table = "users";
        $data = array(
            "id" => $_POST["u_id_u"],
            "user" => $_POST['u_name_u'],
            "name" => $_POST['u_fname_u'],
            "password" => ""
        );

        if (!empty($_POST['u_password_u'])) {
            $data["password"] = md5($_POST['u_password_u']);
        }

        $response = FormsModel::mdlUpdateUser($table, $data);

        return $response;
    }

    public static function ctrDeleteUser()
    {
        $table = "users";
        $idUser = $_POST["u_id_d"];

        $response = FormsModel::mdlDeleteUser($table, $idUser);

        return $response;
    }
}
