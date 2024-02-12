<?php

$user_user_id = $user_first_name = $user_last_name = $user_email = $user_phone_number = $user_dob = $user_house_no = $user_state = $user_city = $user_account_type = $user_profile_url = $user_passwordDB = $user_security_question = $user_question_answer = $user_status = $user_latitude = $user_longitude = "";

if (isset($_SESSION['id'])) {
    if (!empty($_SESSION['id'])) {

        $user_user_id = $_SESSION['id'];

        $selectUserEmailQuery = "SELECT * FROM `user` WHERE `user_id`= '$user_user_id'";
        $resultUserEmail = $conn->query($selectUserEmailQuery);

        if ($resultUserEmail->num_rows > 0) {
            $userData = $resultUserEmail->fetch_assoc();

            $user_first_name = $userData['first_name'];
            $user_last_name = $userData['last_name'];
            $user_email = $userData['email'];
            $user_phone_number = $userData['phone_number'];
            $user_dob = $userData['dob'];
            $user_house_no = $userData['house_no'];
            $user_state = $userData['state'];
            $user_city = $userData['city'];
            $user_account_type = $userData['account_type'];
            $user_profile_url = $userData['profile_url'];
            $user_passwordDB = $userData['password'];
            $user_security_question = $userData['security_question'];
            $user_question_answer = $userData['question_answer'];
            $user_status = $userData['status'];
            $user_latitude = $userData['latitude'];
            $user_longitude = $userData['longitude'];
        }
    }
}
