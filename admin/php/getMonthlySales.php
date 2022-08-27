<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){

        include('connection.php');
        $con = connect();
        if(isset($_POST)){
            $year = $_POST['year'];
            $months = array();
            $sales = array();
            $query = "SELECT * FROM sales WHERE created_at LIKE %'$year'% ORDER BY created_at ASC";
            $previousMonth = "";
            $salesQuery = $con->query($query) or die($con->error);

            $salesPerMonth = 0;
            while($salesRow = $salesQuery->fetch_assoc()){


                $currentMonth = date_create(date_format($salesRow['created_at'], "M"));
                if($previousMonth != $currentMonth){
                    $previousMonth = $currentMonth;

                    $months[] = $previousMonth;
                    $sales[] = $salesPerMonth;
                    $salesPerMonth = 0;
                }

                $salesPerMonth += $salesRow['amount'];
            }

            $response = array(
                'months' => $months,
                'sales' => $sales,
            );

            echo json_encode($response);
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>