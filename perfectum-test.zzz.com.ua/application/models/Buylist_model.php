<?php

class Buylist_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getList($filter = FALSE)
    {
        if ($filter === FALSE){
            $query = $this->db->get('lists');
            return $query->result_array();
        }

        $query = $this->db->get_where('lists', ['category_id' => $filter]);
        return $query->row_array();
    }
    public function getListFilter($filter=[])
    {
        $query = $this->db->get_where('lists', ['bought' => $filter['bought']]);
        $response = $query->result_array();
        return $response;

    }
    public function filterCategory($filter=[])
    {
        $query = $this->db->get_where('lists', ['category_id' => $filter['category_id']]);
        $response = $query->result_array();
        return $response;

    }

    function getListDetails($postData=[])
    {
        $response = [];
        if(isset($postData['bought']) ){

            // Select record
            $this->db->select('*');
            $this->db->where('bought', $postData['bought']);
            $records = $this->db->get('lists');
            $response = $records->result_array();

        }
        return $response;
    }

    public function getCategories($id = FALSE)
    {
        if ($id === FALSE){
            $query = $this->db->get('categr');
            return $query->result_array();
        }
        $query = $this->db->get_where('categr', ['category_id' => $id]);
        return $query->row_array();
    }

    public function addData($postData, $table)
    {
        $addData = [
            'name' => $postData['name'],
            'category_id' => $postData['category_id'],
            'buylist' => $postData['buylist'],
            'bought' => NOT_BOUGHT,
            'creating_date' => date('Y-m-d'),
        ];

        $response = $this->db->insert($table, $addData);
        return $response;
    }

    public function updateData($postData, $table)
    {
        $updateData = [
            'bought' => $postData['bought'],
        ];

        $this->db->where('id', $postData['id']);
        $response = $this->db->update($table, $updateData);
        return $response;

    }

    public function deleteData($postData, $table)
    {
        $this->db->where('id', $postData['id']);
        $response = $this->db->delete($table);
        return $response;
    }

    public function addCategory($postData, $table)
    {
        $addData = [
            'name' => $postData['name']
        ];

        $response = $this->db->insert($table, $addData);
        return $response;
    }
}