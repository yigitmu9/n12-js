<?php

require_once('Database.php');

class LogDatabaseModel extends DatabaseModelBase {

    public function add_log($name, $price){
        $now = microtime(true);
        $id = dechex($now) . "_" . $now;
        $sql = "INSERT INTO log (id, name, price) VALUES (?, ?, ?)";

        $statement = $this->prepare($sql);
        $statement->bind_param('sss', $id, $name, $price);
        $statement->execute();
        $affected_rows = $statement->affected_rows;
        $response = null;

        if($affected_rows > 0)
            $response = array('name' => $name, 'id' => $id, 'price' => $price);
        else
            $response = array('insert_success' => false, 'error_message' => ($statement->error));

        $statement->close();

        return $response;
    }

    public function get_logs () {
        $response = array();

        $sql = "SELECT id, name, price
                FROM log
                ORDER BY id ASC";

        $statement = $this->prepare($sql);
        $statement->bind_result($id, $name, $text);
        $statement->execute();

        while ($statement->fetch()) {
            $log = array();
            $log['id'] = $id;
            $log['name'] = $name;
            $log['price'] = $text;

            array_push($response, $log);
        }

        $statement->close();

        return $response;
    }

    public function get_log($log_id){
        $log = array();
        $sql = "SELECT id, name, price FROM log WHERE id = ?";

        $statement = $this->prepare($sql);
        $statement->bind_param('i', $log_id);
        $statement->bind_result($id, $name, $text);
        $statement->execute();

        while ($statement->fetch()) {
            $log['id'] = $id;
            $log['name'] = $name;
            $log['price'] = $text;
        }

        $statement->close();

        if (empty($id)) {
            return '';
        }

        return $log;
    }

    public function delete_log($log_id){
        $sql = "DELETE FROM log WHERE id = ?";

        $statement = $this->prepare($sql);
        $statement->bind_param('i', $log_id);
        $statement->execute();
        $affected_rows = $statement->affected_rows;
        $statement->close();

        $response = null;

        if ($affected_rows > 0){
            $response = array('delete_success' => true, 'delete_id' => $log_id, 'affected_rows' => $affected_rows);
        }
        else {
            $response = array('delete_success' => false);
        }

        return $response;
    }
}

?>
