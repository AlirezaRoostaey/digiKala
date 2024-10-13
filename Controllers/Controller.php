<?php

namespace Controllers;

class Controller
{

    public function success($data, $message, $code = 200)
    {
        $this->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ]);
    }

    public function error($data = [], $message = null, $code = 400)
    {
        $this->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ]);
    }

    private function json($response)
    {
        http_response_code($response['code']);
        header('Content-Type: application/json');


         echo json_encode($response);
    }
}