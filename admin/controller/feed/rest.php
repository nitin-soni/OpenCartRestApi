<?php

/**
 * 
 * @author Nitin Kukmar Soni (soninitin27@gmail.com)
 * 
 */
class ControllerFeedRest extends Controller {

    public function __construct($registry) {
        parent::__construct($registry);
        $this->load->language('feed/rest');
        $this->load->model('setting/setting');

        $this->data = array(
            'version' => '0.1',
            'heading_title' => $this->language->get('heading_title'),
            'text_enabled' => $this->language->get('text_enabled'),
            'text_disabled' => $this->language->get('text_disabled'),
            'tab_general' => $this->language->get('tab_general'),
            'entry_status' => $this->language->get('entry_status'),
            'entry_key' => $this->language->get('entry_key'),
            'entry_user' => $this->language->get('entry_user'),
            'button_save' => $this->language->get('button_save'),
            'button_cancel' => $this->language->get('button_cancel'),
            'action' => $this->url->link('feed/rest', 'token=' . $this->session->data['token'], 'SSL'),
            'cancel' => $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL')
        );
    }

    function index() {
        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            //Validate
            if ($this->request->post['api_status'] == 1) {
                if ($this->validate($this->request->post) == FALSE) {
                    $this->model_setting_setting->editSetting('rest', $this->request->post);
                    $this->session->data['success'] = $this->language->get('text_success');
                    $this->redirect($this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL'));
                }
            }else {
                $data = array(
                    'api_user' => NULL,
                    'api_key' => NULL,
                    'api_status' => 0
                );
                $this->model_setting_setting->editSetting('rest', $this->request->post);
                $this->session->data['success'] = $this->language->get('text_success');
                $this->redirect($this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL'));
                //$this->model_setting_setting->deleteSetting('rest');
            }
        }

        //Setup Breadcrumbs
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_feed'),
            'href' => $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('feed/rest', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        //Start Form Data Logic
        if (isset($this->request->post['api_status'])) {
            $this->data['api_status'] = $this->request->post['api_status'];
        } else {
            $this->data['api_status'] = $this->config->get('api_status');
        }

        if (isset($this->request->post['api_key'])) {
            $this->data['api_key'] = $this->request->post['api_key'];
        } else {
            $this->data['api_key'] = $this->config->get('api_key');
        }

        if (isset($this->request->post['api_user'])) {
            $this->data['api_user'] = $this->request->post['api_user'];
        } else {
            $this->data['api_user'] = $this->config->get('api_user');
        }

        $this->template = 'feed/rest.tpl';

        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    /**
     * Validate User Form
     * @param type $data
     * @return boolean
     */
    private function validate($data) {
        $error = false;
        //echo '<pre>'; print_r($data); die;
        //if ($data['api_status'] == 1) {
        if ((utf8_strlen($data['api_user']) < 1) || (utf8_strlen($data['api_user']) > 16)) {
            $this->data['error_api_user'] = $this->language->get('error_api_user');
            $error = true;
        }
        if ((utf8_strlen($data['api_key']) < 1) || (utf8_strlen($data['api_key']) > 16)) {
            $this->data['error_api_key'] = $this->language->get('error_api_key');
            $error = true;
        }
        if($error) {
            $this->data['error_warning'] = $this->language->get('error_warning');
        }
        //}
        //var_dump($error);die;
        return $error;
    }

}
