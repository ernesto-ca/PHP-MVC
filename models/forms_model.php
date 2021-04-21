<?php

require_once "connection.php";

class FormsModel
{
    /* SIGN UP Function
        *
        * Insert a new user into the respective table
        * @param {String} table -> the current table to insert
        * @param {Array} data -> all data of the new user
        *
        * return {Boolean} -> if the statement was a success
        */
    public static function mdlSignIn($table, $data)
    {
        $statement = Connection::connect()->prepare("INSERT INTO $table(user,name,password) VALUES (:user,:name,:password)");
        $statement->bindParam(":user", $data["user"], PDO::PARAM_STR);
        $statement->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $statement->bindParam(":password", $data["password"], PDO::PARAM_STR);

        if ($statement->execute()) {
            return true;
        } else {
            print_r(Connection::connect()->errorInfo());
        }

        $statement->closeCursor();
        $statement = null;

        return false;
    }

    /* Log In Function
        *
        * Check for a current user in the table
        * @param {String} table -> the current table to check
        * @param {Array} data -> all data of the current user
        *
        * return {Array} -> the response of the query
        */
    public static function mdlLogIn($table, $data)
    {
        $statement = Connection::connect()->prepare("SELECT * FROM $table WHERE  user = :user AND password = :password");
        $statement->bindParam(":user", $data["user"], PDO::PARAM_STR);
        $statement->bindParam(":password", $data["password"], PDO::PARAM_STR);

        if ($statement->execute()) {
            return $statement->fetch();
        } else {
            print_r(Connection::connect()->errorInfo());
            print_r(Connection::connect()->errorCode());
        }

        $statement->closeCursor();
        $statement = null;

        return false;
    }

    /* Select All Function
        *
        * Get all users in the DB
        * @param {String} table -> the current table to select
        *
        * return {Array} -> the array with all users
        */
    public static function mdlSelectAll($table)
    {
        $statement = Connection::connect()->prepare("SELECT * FROM $table");

        if ($statement->execute()) {
            return $statement->fetchAll();
        } else {
            print_r(Connection::connect()->errorInfo());
            print_r(Connection::connect()->errorCode());
        }

        $statement->closeCursor();
        $statement = null;

        return null;
    }

    /* Update User Function
        *
        * Update one user in the table 
        * @param {String} table -> the current table to update
        * @param {Array} data -> all the new data for the current user to update
        *
        * return {Boolean} -> if the update was successfully
        */
    public static function mdlUpdateUser($table, $data)
    {
        if (!empty($data["password"])) {
            $statement = Connection::connect()->prepare("UPDATE $table SET user = :user, name = :fname, password = :password  WHERE id = :id");
            $statement->bindParam(":password", $data["password"], PDO::PARAM_STR);
        } else {
            $statement = Connection::connect()->prepare("UPDATE $table SET user = :user, name = :fname  WHERE id = :id");
        }
        $statement->bindParam(":user", $data["user"], PDO::PARAM_STR);
        $statement->bindParam(":fname", $data["name"], PDO::PARAM_STR);
        $statement->bindParam(":id", $data["id"], PDO::PARAM_INT);

        if ($statement->execute()) {
            return true;
        } else {
            print_r(Connection::connect()->errorInfo());
            print_r(Connection::connect()->errorCode());
        }

        $statement->closeCursor();
        $statement = null;

        return false;
    }

    /* Selete User Function
        *
        * Delete one user in the table 
        * @param {String} table -> the current table to delete
        * @param {Array} data -> all the new data for the current user to delete
        *
        * return {Boolean} -> if the delete was successfully
        */
    public static function mdlDeleteUser($table, $idUser)
    {

        $statement = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");
        $statement->bindParam(":id", $idUser, PDO::PARAM_INT);

        if ($statement->execute()) {
            return true;
        } else {
            print_r(Connection::connect()->errorInfo());
            print_r(Connection::connect()->errorCode());
        }

        $statement->closeCursor();
        $statement = null;

        return false;
    }
}
