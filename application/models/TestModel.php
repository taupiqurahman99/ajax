<?php
class TestModel extends CI_Model{

	public function insertData($data)
	{
		$this->db->insert("testing", $data);


	}

	public function getData()
	{
		$data = $this->db->get('testing');

		if($data->num_rows()>0)
		{
			return $data->result();
		}
		else
		{
			return false;
		}
	}

	public function deleteUserData($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("testing");
	}

	public function fetchSingleData($id)
	{
		$this->db->where("id", $id);
		$data = $this->db->get("testing");
		if($data->num_rows()>0)
		{
			return $data->result();
		}
		else
		{
			return false;
		}
	}

	public function updateData($id,$data)
	{
		$this->db->where("id", $id);
		$this->db->update("testing", $data);
	}
}

?>