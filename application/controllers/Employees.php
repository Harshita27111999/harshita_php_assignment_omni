<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
        $this->load->library('DbHandler');
        $this->conn = "";

        // opening db connection
        require_once dirname(__FILE__) . '/../libraries/DbConnect.php';
        $db         = new DbConnect();
        $this->conn = $db->connect();
        mysqli_set_charset($this->conn, 'utf8');
    }
    
	public function index()
	{
		$this->load->view('header');
	    $this->load->view('employees_data');
	    $this->load->view('footer');
	}

    public function employeesForm()
    {
        $this->load->view('header');
		$this->load->view('employees_form');
		$this->load->view('footer');
    }
    
    public function getEmployeeDetails() 
    {
        header('Content-Type: application/json');
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $response = $this->dbhandler->getEmployeeDetails($page, $limit, $start_date, $end_date);    
        echo json_encode($response);
        exit;
    }  
    
    public function getNextEmpCode()
    {
        $response = $this->dbhandler->getNextEmpCode();    
        echo json_encode($response);       
    }
    
    public function addEmployees() 
    { 
        header('Content-Type: application/json'); 
    
        $emp_code = isset($_POST['emp_code']) ? $_POST['emp_code'] : null;
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
        $date = isset($_POST['date']) ? $_POST['date'] : null;
    
        if (!$emp_code || !$first_name || !$last_name) {
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            return;
        }
    
        $is_profile_image_set = isset($_FILES['profile_image']) && $_FILES['profile_image']['size'] > 0;
        $profile_image = $is_profile_image_set ? $_FILES['profile_image'] : null;
    
        $response = $this->dbhandler->addEmployee($emp_code, $first_name, $last_name, $date, $profile_image, $is_profile_image_set);
        echo json_encode($response);
    }
    

}