<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        session_start();
        include('connection.php');
        $con = connect();
    
        if(isset($_POST)){
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $userType = 'admin';
            $query = $con->prepare("SELECT * FROM users WHERE email = ? AND user_type = ?");
            $query->bind_param('ss', $email, $userType);
            $query->execute();
            $result = $query->get_result();
            if($row = $result->fetch_assoc()){
                if(password_verify($password,$row['password'])){
                    $userId = $row['id'];
                    $_SESSION['user_id'] = $userId;
                    echo "main-page.html";
                }else{
                    echo "Invalid Data";
                }
            }else{
                echo "Invalid Data";
            }
        }else{
            echo "Invalid Data";
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
    
?>