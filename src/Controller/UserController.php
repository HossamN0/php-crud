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
        $userData = filter_input_array(INPUT_POST);
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
}

?>