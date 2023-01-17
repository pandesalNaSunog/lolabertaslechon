<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        include('../../admin/php/connection.php');
        $con = connect();
        $today = today();
        if(isset($_POST)){
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
            $address = htmlspecialchars($_POST['address']);
            $contact = htmlspecialchars($_POST['contact']);

            $query = $con->prepare('SELECT * FROM users WHERE email = ?');
            $query->bind_param('s', $email);
            $query->execute();
            $result = $query->get_result();
            if($data = $result->fetch_assoc()){
                echo 'email exists';
            }else{
                $query = $con->prepare('INSERT INTO users (name, email, password, contact_number, created_at, updated_at)VALUES(?,?,?,?,?,?)');
                $query->bind_param('ssssss', $name, $email, $password, $contact, $today, $today);
                $query->execute();

                $query = "SELECT * FROM users WHERE id = LAST_INSERT_ID()";
                $result = $con->query($query);
                $data = $result->fetch_assoc();

                

                session_start();
                $_SESSION['client_user_id'] = $data['id'];
                $userId = $data['id'];
                $query = $con->prepare('INSERT INTO delivery_addresses(user_id, address, created_at, updated_at)VALUES(?,?,?,?)');
                $query->bind_param('isss', $userId, $address, $today, $today);
                $query->execute();
                echo 'ok';
            }
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>