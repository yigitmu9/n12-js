<?php



require_once('Database.php');
require_once('model/LogDatabaseModel.php');

class Log extends RestController {

    private $logdbm;

    public function __construct($request) {
        $this->request = $request;
        $db = new DatabaseConnection();
        $this->logdbm = new logDatabaseModel($db);
    }

    public function get() {
        if (!empty($this->request['params']['log_id'])) {
            $this->response = $this->logdbm->get_log($this->request['params']['log_id']);
        }
        else {
            $this->response = $this->logdbm->get_logs();
        }
    }

    public function post() {
        $params = $this->request['params'];

        if ($params != null) {
            $this->response = $this->logdbm->add_log($params['name'], $params['price']);
        }
        else {
            $this->response = $this->jsonError(json_last_error());
            $this->responseStatus = 406; // Not Acceptable
        }
    }

    public function put() {
        $this->response = $this->jsonError(json_last_error());
        $this->responseStatus = 406; // Not Acceptable
    }

    public function delete() {
        if (!empty($this->request['params']['log_id'])) {
            $this->response = $this->logdbm->delete_log($this->request['params']['log_id']);
        }
        else {
            $this->responseStatus = 400;
        }
    }

}


?>
