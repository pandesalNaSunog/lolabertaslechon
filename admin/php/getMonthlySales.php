<?php
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){

        include('connection.php');
        $con = connect();
        if(isset($_POST)){
            $year = $_POST['year'];
            $months = array();
            $sales = array();
            $query = "SELECT * FROM sales WHERE created_at LIKE '%$year%' ORDER BY created_at ASC";
            $salesQuery = $con->query($query) or die($con->error);
            $previousMonth = "";
            $salesPerMonth = 0;
            $index = 0;

            $maximum = 0;
            while($salesRow = $salesQuery->fetch_assoc()){
                
                
                
                $currentMonth = date_format(date_create($salesRow['created_at']), "M");
                if($previousMonth != $currentMonth && $previousMonth != ""){
                    $months[] = $previousMonth;
                    $sales[] = $salesPerMonth;

                    if($salesPerMonth > $maximum){
                        $maximum = $salesPerMonth;
                    }
                    $salesPerMonth = 0;
                }
                $salesPerMonth += $salesRow['amount'];

                $previousMonth = $currentMonth;
                $index++;
            }

            $months[] = $previousMonth;
            $sales[] = $salesPerMonth;
            if($salesPerMonth > $maximum){
                $maximum = $salesPerMonth;
            }
            $salesPerMonth = 0;
            

            $response = array(
                'months' => $months,
                'sales' => $sales,
                'maximum' => $maximum
            );

            echo json_encode($response);
        }
    }else{
        echo header('HTTP/1.1 403 Forbidden');
    }
?>