<?php

class Policy
{
    public $conn;
    public $first_name;
    public $last_name;
    public $birthdate;
    public $passport_id;
    public $phone;
    public $email;
    public $date_from;
    public $date_to;
    public $policy_type;

    public function __construct($dbh)
    {
        $this->conn = $dbh;
    }

    public function newPolicy()
    {
        $query = "INSERT into policy_owner(first_name, last_name, birthdate, passport_id, phone, email, date_from, date_to, policy_type) values(:first_name, :last_name, :birthdate, :passport_id, :phone, :email, :date_from, :date_to, :policy_type)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":birthdate", $this->birthdate);
        $stmt->bindParam(":passport_id", $this->passport_id);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":date_from", $this->date_from);
        $stmt->bindParam(":date_to", $this->date_to);
        $stmt->bindParam(":policy_type", $this->policy_type);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function additionalInsured($first_name, $last_name, $birthdate, $passport_id, $policy_owner_id)
    {
        $query = "INSERT INTO additional_insured(first_name, last_name, birthdate, passport_id, policy_owner_id) VALUES(:first_name, :last_name, :birthdate, :passport_id, :policy_owner_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":first_name", $first_name);
        $stmt->bindParam(":last_name", $last_name);
        $stmt->bindParam(":birthdate", $birthdate);
        $stmt->bindParam(":passport_id", $passport_id);
        $stmt->bindParam(":policy_owner_id", $policy_owner_id);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readPolicy()
    {
        $query = "SELECT * FROM policy_owner";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
