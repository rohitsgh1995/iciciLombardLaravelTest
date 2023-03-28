<?php

    include('dbcon.php');

    $connect = new PDO("mysql:host=$hostName; dbname=$dbName", $userName, $password);

    if(isset($_POST["action"]))
    {
        $query = "select * from vehicles";

        if(isset($_POST["reg_num"]))
        {
            if(!empty($_POST["reg_num"]))
            {
                $r = $_POST["reg_num"];
                $query .= " where reg_num like '%$r%'";
            }
        }

        if(isset($_POST["engine_num"]) && isset($_POST["chassis_num"]))
        {
            if(!empty($_POST["engine_num"]) && !empty($_POST['chassis_num']))
            {
                $e = $_POST["engine_num"];
                $c = $_POST["chassis_num"];
                $query .= " where engine_num like '%$e%' and chassis_num like '%$c%'";
            }
        }

        if(isset($_POST["vin_num"]))
        {
            if(!empty($_POST["vin_num"]))
            {
                $v = $_POST["vin_num"];
                $query .= " where vin_num like '%$v%'";
            }
        }
        
        $query .= " order by id";

        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();

        $output = '';

        $output .=
        '<table class="table table-sm table-hover text-center table-bordered">
                <thead>
                    <th>ID</th>
                    <th>Reg Num</th>
                    <th>Engine Num</th>
                    <th>Chassis Num</th>
                    <th>Vin Num</th>
                </thead>
                <tbody>
        ';
        
        if($total_row > 0)
        {
            foreach($result as $row)
            {
                $output .=
                '       
                    <tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['reg_num'].'</td>
                        <td>'.$row['engine_num'].'</td>
                        <td>'.$row['chassis_num'].'</td>
                        <td>'.$row['vin_num'].'</td>
                    </tr>
                ';
            
            }
        }
        else
        {
            $output .= 
            '
                <tr>
                    <td class="text-center" colspan="5">False. No Data Found!</td>
                </tr>                
            ';
        }

        $output .=
        '       </tbody>
            </table>
        ';
        
        echo $output;

    }

?>