<?php

namespace Hossam\ActionsNextJs\Model;
use Hossam\ActionsNextJs\Model;

class UserModel extends Model
{
    private $tableName = 'users';

    public function InsertUser($data)
    {
        if (empty($data['name'])) {
            http_response_code(400);
            return [
                'status' => 'error',
                'message' => 'Name is required',
                'code' => 400
            ];
        }

        if (empty($data['email'])) {
            http_response_code(400);
            return [
                'status' => 'error',
                'message' => 'Email is required',
                'code' => 400
            ];
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            return [
                'status' => 'error',
                'message' => 'Invalid email format',
                'code' => 400
            ];
        }

        if (empty($data['password'])) {
            http_response_code(400);
            return [
                'status' => 'error',
                'message' => 'Password is required',
                'code' => 400
            ];
        }

        $hased_password = password_hash($data['password'], PASSWORD_DEFAULT);
        try {
            $emailfound = $this->query("SELECT id FROM $this->tableName WHERE email = :email")
                ->execute([
                    ':email' => $data['email']
                ])->getStmt();

            if ($emailfound->rowCount()) {
                http_response_code(409);
                return [
                    'status' => 'error',
                    'message' => 'Email already exists',
                    'code' => 409
                ];
            }

            $stmt = $this->query("INSERT INTO $this->tableName (name, email, password) VALUES (:name,:email,:password)")
                ->execute([
                    ':name' => $data['name'],
                    ':email' => $data['email'],
                    ':password' => $hased_password
                ])->getStmt();

            if ($stmt->rowCount() > 0) {
                http_response_code(201);
                return [
                    'status' => 'success',
                    'message' => 'User added successfully',
                    'code' => 201
                ];
            } else {
                http_response_code(500);
                return [
                    'status' => 'error',
                    'message' => 'Failed to add user',
                    'code' => 500
                ];
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            return [
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage(),
                'code' => 500
            ];
        }
    }

    public function GetUser($id)
    {
        $result = $this->query("SELECT id, name, email, created_at FROM $this->tableName WHERE id = :id")
            ->execute([
                ':id' => $id
            ])->getStmt();
        if ($result->rowCount() > 0) {
            http_response_code(200);
            return [
                'status' => 'success',
                'message' => 'User Found',
                'code' => 200,
                'user' => $result->fetch(\PDO::FETCH_ASSOC)
            ];
        } else {
            http_response_code(400);
            return [
                'status' => 'error',
                'message' => 'User Not Found',
                'code' => 400,
            ];
        }
    }
}
?>