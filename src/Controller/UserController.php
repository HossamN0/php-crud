<?php

namespace Hossam\ActionsNextJs\Controller;
use Hossam\ActionsNextJs\Model\UserModel;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function insert()
    {
        // formData
        // $userData = filter_input_array(INPUT_POST);

        // json data
        $jsonData = file_get_contents('php://input');
        $userData = json_decode($jsonData, true);

        $result = $this->userModel->InsertUser($userData);
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function Get($id)
    {
        if (!$id) {
            return;
        }
        $reult = $this->userModel->GetUser($id);
        header('Content-Type:application/json');
        echo json_encode($reult);
        exit;
    }

    public function Update($id)
    {
        $jsonData = file_get_contents('php://input');
        $userData = json_decode($jsonData, true);
        $result = $this->userModel->UpdateUser($userData, $id);
        header('Content-Type:application/json');
        echo json_encode($result);
        exit;
    }

    public function Delete($id)
    {
        $result = $this->userModel->DeleteUser($id);
        header('Content-Type:application/json');
        echo json_encode($result);
        exit;
    }
}

?>