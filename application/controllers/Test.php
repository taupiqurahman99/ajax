<?php
class Test extends CI_Controller
{
	
	public function __construct()
	{

		parent::__construct();
	$this->load->model("testModel");
	}
	public function index()
	{
		$this->load->view('tesView');
	}
	public function insertData()
	{
		$data = array(
			'name' => $this->input->post("name"),
			'mobile' => $this->input->post("mobile"),
			'email' => $this->input->post("email"),
			'alamat' => $this->input->post("alamat"),
			'status_email' => $this->input->post("status_email"),
			'status_telp' => $this->input->post("status_telp"),
			'status_pemesanan' => $this->input->post("status_pemesanan")
		);


		if($this->input->post("submit") == "submit")
		{
			$this->testModel->insertData($data);
		}
		if($this->input->post("submit") == "update")
		{
			$id = $this->input->post("singleID"); 
			$this->testModel->updateData($id,$data);
		}
	}
	public function getData()
	{
		$data = $this->testModel->getData();
		echo json_encode($data);
	}

	public function deleteUserData()
	{
		$id = $this->input->post("delId");
		$this->testModel->deleteUserData($id);
	}

	public function fetchSingleData()
	{
		$id= $this->input->post("eID");
		$data = $this->testModel->fetchSingleData($id);
		echo json_encode($data);
	}
}
?>