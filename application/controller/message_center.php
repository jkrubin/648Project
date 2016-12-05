<?php

Class Message_Center extends Controller {

    public function index() {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/message_center/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function sendMessage() {
        try {
            $params = array(':body' => $_POST['body'], 'senderId' => $_POST['senderId'], ':recipientId' => $_POST['recipientId'],
                ':listingId' => $_POST['listingId'], ':true' => true);
            if (array_key_exists('title', $_POST)) {
                $params[':title'] = $_POST['title'];
            }
            $this->model->send_message($params);
        } catch (Exception $e) {
            echo 'Error', $e->getMessage();
        }
    }

    public function get_new_messages(): array {
        try {
            return $this->model->get_new_messages($_POST['userId']);
        } catch (Exception $e) {
            echo 'Error', $e->getMessage();
        }
    }

    public function view_message(): array {
        try {
            return $this->model->view_message($_POST['messageId']);
        } catch (Exception $e) {
            echo 'Error', $e->getMessage();
        }
    }

    public function get_old_messages(): array {
        try {
            return $this->model->view_message($_POST['userId']);
        } catch (Exception $e) {
            echo 'Error', $e->getMessage();
        }
    }

    public function delete_message() {
        try {
            $this->model->delete_message($_POST['messageId']);
        } catch (Exception $e) {
            echo 'Error', $e->getMessage();
        }
    }

}

?>
