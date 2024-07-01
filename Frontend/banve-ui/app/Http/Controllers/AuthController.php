<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->post('http://localhost:8081/auth/login', [
                'json' => [
                    'username' => $request->input('email'),
                    'password' => $request->input('password')
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            if ($body['code'] == 1000) {
                // Lưu token và thông tin người dùng vào session
                Session::put('jwt_token', $body['result']['token']);
                Session::put('user', $body['result']);
                return redirect()->route('home.index'); // Chuyển hướng về trang chủ
            } else {
                return redirect()->back()->with('error', $body['message']);
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Lấy thông báo lỗi từ response của API
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $body = json_decode($responseBodyAsString, true);

            return redirect()->back()->with('error', $body['message'] ?? 'An error occurred.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        Session::forget(['jwt_token', 'user']);
        return redirect()->route('home.index');
    }
}