<?php

require "bootstrap.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['json'])) {
    $policy_json = $_POST['json'];
    $policy_json = json_decode($policy_json, TRUE);
    $errors = "";

    $policy->first_name = ucfirst($policy_json['first_name']);
        $policy->last_name = ucfirst($policy_json['last_name']);
    if (!empty($policy_json['birthdate'])) {
        $policy->birthdate = $policy_json['birthdate'];
    } else {
        $errors .= "Date missing.<br>";
    }
    
    if (!strlen($policy_json['passport_id']) == 9 || !is_numeric($policy_json['passport_id'])) {
        $errors .= "Invalid passport id.<br>";
    } else {
        $policy->passport_id = $policy_json['passport_id'];
    }
    
    if (!strlen($policy_json['phone']) == 9
        || !strlen($policy_json['phone']) == 10
        || !is_numeric($policy_json['phone'])) {
            $errors .= "Invalid phone number.<br>";
    } else {
        $policy->phone = $policy_json['phone'];
    }

    if(filter_var($policy_json['email'], FILTER_VALIDATE_EMAIL)) {
        $policy->email = $policy_json['email'];
    } else {
        $errors .= "Invalid email.<br>";
    }
    
    if (!empty($policy_json['date_from'])) {
        $policy->date_from = $policy_json['date_from'];
    } else {
        $errors .= "Date missing.<br>";
    }

    if (!empty($policy_json['date_to'])) {
        $policy->date_to = $policy_json['date_to'];
    } else {
        $errors .= "Date missing.<br>";
    }
    
    $policy->policy_type = $policy_json['policy_type'];

        if($policy->newPolicy()){
            if(!empty($policy_json['additional'])) {
                $passport_id = $policy_json['passport_id'];
                $query = "SELECT id FROM policy_owner WHERE passport_id = '$passport_id' LIMIT 1";
                $stmt = $policy->conn->prepare($query);
                if($stmt->execute()) {
                    $policy_owner_id = $stmt->fetch();
                    $policy_owner_id = $policy_owner_id['id'];
                }

                for($i=0; $i<sizeof($policy_json['additional']); $i++) {
                    $policy->additionalInsured(
                        $policy_json['additional'][$i]['first_name'],
                        $policy_json['additional'][$i]['last_name'],
                        $policy_json['additional'][$i]['birthdate'],
                        $policy_json['additional'][$i]['passport_id'],
                        $policy_owner_id
                    );
                }
            }
            echo "<div class='alert alert-success'>Policy successfully created.</div>";
        } else{            
            echo "<div class='alert alert-danger'>Error.</div>";
        }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/sorttable.js"></script>
    <title>Policy</title>
</head>
<body style="background: whitesmoke;">
<nav id="top" class="navbar navbar-expand-lg navbar-dark bg-light">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">New policy</a>
            </li>&nbsp;
            <li class="nav-item">
                <a class="nav-link" href="view.php">Overview</a>
            </li>
        </ul>
    </div>
</nav>