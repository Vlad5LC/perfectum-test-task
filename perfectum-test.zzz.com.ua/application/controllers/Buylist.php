<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Buylist extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('buylist_model');
        $this->load->helper('url');
        //$this->config->load('filename');

    }

    public function index() {

        $data['title'] = 'Список покупок';
        $data['buylist'] = $this->buylist_model->getList();
        $data['categr'] = $this->buylist_model->getCategories();

        $this->load->view('templates/header', $data);
        $this->load->view('buylist/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL){
        $data['list_item'] = $this->buylist_model->getList($slug);

        if (empty($data['list_item'])){
            show_404();
        }

        $data['title'] = $data['list_item']['name'];
        $data['content'] = $data['list_item']['status'];

        $this->load->view('templates/header', $data);
        $this->load->view('buylist/view', $data);
        $this->load->view('templates/footer');
    }
    public function listsDetail()
    {
        // POST data
        $postData['bought'] = $this->input->post('bought');
        $postData['id'] = $this->input->post('id');

        $data = $this->buylist_model->updateData($postData, 'lists');
        echo json_encode($data);
    }
    public function addNewList()
    {
        // POST data
        $postData['name'] = $this->input->post('name');
        $postData['category_id'] = $this->input->post('category_id');
        $postData['buylist'] = $this->input->post('buylist');

        $data = $this->buylist_model->addData($postData, 'lists');
        echo json_encode($data);
    }

    public function deleteList()
    {
        // POST data
        $postData['id'] = $this->input->post('id');

        $data = $this->buylist_model->deleteData($postData, 'lists');
        echo json_encode($data);
    }

    public function addCategory()
    {
        // POST data
        $postData['name'] = $this->input->post('name');

        $data = $this->buylist_model->addCategory($postData, 'categr');
        echo json_encode($data);
    }
    public function indexNew() {

        $postData['bought'] = $this->input->post('bought');
        $data['buylist'] = $this->buylist_model->getListFilter($postData);
        $data['categr'] = $this->buylist_model->getCategories();

        foreach ($data['buylist'] as $key => $list) {
            if ($list['bought']){
                $bought = 'checked';
            }
            else {
                $bought = '';
            }

            foreach ($data['categr'] as $category) {
                if ($category['id'] == $list['category_id']){
                    $thisCategory = $category['name'];
                }
            }
            $htmlReady[] = '<div class="col mb-5" id="'.$list['id'].'">
                    <div class="card h-100 buylist">
                        <!-- Product details-->
                        <div title="'.DELETE.'" class="delete_icon" data-id="'.$list['id'].'"></div>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">'.$list['name'].'</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">'.$list['creating_date'].'</span>
                                <br>
                                <span class="text-muted text-decoration-line-through">Категорія: '.$thisCategory.'</span>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" data-id="'.$list['id'].'" id="save-info'.$key.'"  ' . $bought . '>
                                <label class="custom-control-label" for="save-info'.$key.'">Куплено</label>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        echo json_encode($htmlReady);


    }
    public function categoryNew() {

        $postData['category_id'] = $this->input->post('category_id');
        $data['buylist'] = $this->buylist_model->filterCategory($postData);
        $data['categr'] = $this->buylist_model->getCategories();

        foreach ($data['buylist'] as $key => $list) {
            if ($list['bought']){
                $bought = 'checked';
            }
            else {
                $bought = '';
            }

            foreach ($data['categr'] as $category) {
                if ($category['id'] == $list['category_id']){
                    $thisCategory = $category['name'];
                }
            }
            $htmlReady[] = '<div class="col mb-5" id="'.$list['id'].'">
                    <div class="card h-100 buylist">
                        <!-- Product details-->
                        <div title="'.DELETE.'" class="delete_icon" data-id="'.$list['id'].'"></div>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">'.$list['name'].'</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">'.$list['creating_date'].'</span>
                                <br>
                                <span class="text-muted text-decoration-line-through">Категорія: '.$thisCategory.'</span>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" data-id="'.$list['id'].'" id="save-info'.$key.'"  ' . $bought . '>
                                <label class="custom-control-label" for="save-info'.$key.'">Куплено</label>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        echo json_encode($htmlReady);


    }
}