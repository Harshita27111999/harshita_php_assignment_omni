<?php

class DbHandler {
    private $conn;

    private $image_path='Upload/';
    private $image_url='http://localhost/omni_sol/assets/img/';

    function __construct(){
        require_once dirname(__FILE__) .'/DbConnect.php';
        //opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function getEmployeeDetails($page = 1, $limit = 5, $start_date = null, $end_date = null) 
    {
        $offset = ($page - 1) * $limit;
    
        $count_query = "SELECT COUNT(*) AS total FROM employee WHERE 1=1";
    
        if (!empty($start_date) && !empty($end_date)) {
            $count_query .= " AND date BETWEEN '$start_date' AND '$end_date'";
        }
    
        $count_result = $this->conn->query($count_query);
        if ($count_result) {
            $total_records = $count_result->fetch_assoc()['total'];
        } else {
            return array('success' => false, 'message' => 'Database error in count query');
        }
    
        $total_pages = ceil($total_records / $limit);
    
        $sql_query = "SELECT * FROM employee WHERE 1=1";
    
        if (!empty($start_date) && !empty($end_date)) {
            $sql_query .= " AND date BETWEEN '$start_date' AND '$end_date'";
        }
    
        $sql_query .= " LIMIT $limit OFFSET $offset";
    
        $stmt = $this->conn->query($sql_query);
    
        if (!$stmt) {
            return array('success' => false, 'message' => 'Database error in data query');
        }
    
        $list = array();
        while ($row = $stmt->fetch_assoc()) {
            $list[] = array(
                'emp_id' => $row['emp_id'],
                'emp_code' => $row['emp_code'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'date' => $row['date'],
                'profile_image' => $row['profile_image']
            );
        }
    
        $stmt->close();
    
        return array(
            'success' => count($list) > 0,
            'employee' => $list,
            'total_pages' => $total_pages
        );
    }  
    
    public function getNextEmpCode() {
        $sql = "SELECT emp_code FROM employee ORDER BY emp_id DESC LIMIT 1";
        $stmt = $this->conn->query($sql);
    
        if (!$stmt) {
            return json_encode([
                'success' => false,
                'message' => 'Database Query Failed'
            ]);
        }
    
        $row = $stmt->fetch_assoc(); // Fetch the latest employee code
    
        if ($row) {
            $lastCode = $row['emp_code'];
            $number = intval(substr($lastCode, 4)) + 1; // Extract number and increment
            $newCode = "EMP-" . str_pad($number, 4, '0', STR_PAD_LEFT); // Format EMP-000X
        } else {
            $newCode = "EMP-0001"; // First employee code
        }
    
        $stmt->close();
    
        $result=array(
            'success' => true,
            'emp_code' => $newCode
        );
        return $result;
    }
    
    public function addEmployee($emp_code, $first_name, $last_name, $date, $profile_image, $is_profile_image_set) 
    {
        $sql_query = "CALL addEmployee(?,?,?,?,@is_done,@emp_id)";
        
        $stmt = $this->conn->prepare($sql_query);
        $stmt->bind_param('ssss', $emp_code, $first_name, $last_name, $date);
        $stmt->execute();
        $stmt->close();

        // Fetch the result of the stored procedure
        $stmt1 = $this->conn->prepare("SELECT @is_done AS is_done, @emp_id AS emp_id");
        $stmt1->execute();
        $stmt1->bind_result($is_done, $emp_id);
        $stmt1->fetch();
        $stmt1->close();

        $result = array();   

        if ($is_done == '1') {  
            if ($is_profile_image_set) {
                if (!file_exists($this->image_path)) {
                    mkdir($this->image_path, 0777, true);
                }
                $extension = pathinfo($profile_image['name'], PATHINFO_EXTENSION);
                $filename = time() . '_img.' . $extension;
                $file = $this->image_path . $filename;

                if (move_uploaded_file($profile_image['tmp_name'], $file)) {
                    $stmt2 = $this->conn->query("UPDATE employee SET profile_image = '$filename' WHERE emp_id = $emp_id");
                }
            }

            $result = array(
                'success' => true,
                'message' => 'Employee add successfully'
            );
        } else {
            $result = array(
                'success' => false,
                'message' => 'INSERT_FAILED',
                'emp_id' => $emp_id,
                'is_done'=> $is_done
            );
        }

        return $result;
    }

}