<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PaymentModel;
use App\Models\MagazineModel;

class UserController extends BaseController
{
	
	public function __construct()
    {
        $this->paymentModel = new PaymentModel();
    }
    // Method to display the registration form and handle the registration logic
    public function register()
    {
        helper(['form']);

        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'name'          => 'required|min_length[3]|max_length[50]',
                'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password'      => 'required|min_length[8]|max_length[255]',
                'confpassword'  => 'matches[password]'
            ];

            $errors = [
                'email' => [
                    'is_unique' => 'This email address is already in use.'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                return view('register', [
                    'validation' => $this->validator
                ]);
            } else {
                $model = new UserModel();
                $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

                $data = [
                    'name'     => $this->request->getVar('name'),
                    'email'    => $this->request->getVar('email'),
                    'password' => $password,
					'status' => 1
                ];

                $model->save($data);

                return redirect()->to('user/login')->with('success', 'Registration successful. Please login.');
            }
        }

        return view('register');
    }

   // Method to display the login form and handle login logic
public function login()
{
    helper(['form']);

    if ($this->request->getMethod() == 'POST') {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[8]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return view('login', [
                'validation' => $this->validator
            ]);
        } else {
            $model = new UserModel();
            $user = $model->where('email', $this->request->getVar('email'))->first();

            if ($user) {
                // Check if the user is active
                if ($user['status'] == 0) {
                    return redirect()->to('user/login')->with('error', 'Your account is inactive. Please contact support.');
                }

                // Verify the password
                if (password_verify($this->request->getVar('password'), $user['password'])) {
                    $this->setUserSession($user);
                    return redirect()->to('user/dashboard');
                } else {
                    return redirect()->to('user/login')->with('error', 'Invalid login credentials.');
                }
            } else {
                return redirect()->to('user/login')->with('error', 'User not found.');
            }
        }
    }

    return view('login');
}

    // Method to set user session data after successful login
    private function setUserSession($user)
    {
        $data = [
            'id'       => $user['id'],
            'name'     => $user['name'],
            'email'    => $user['email'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    // Method to handle user dashboard logic (to be implemented)
    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('user/login');
        }

    $model = new MagazineModel();
    $data['magazines'] = $model->findAll(); // Fetch all magazines from the database

        // Load the dashboard view
        return view('dashboard', $data);
    }


  public function paymentHistory()
    {
        $userId = session()->get('id'); // Get the user ID from the session

        // Pagination configuration
        $page = $this->request->getVar('page') ?? 1; // Current page number
        $perPage = 5; // Number of items per page

        // Fetch payment history for the logged-in user with pagination
        $totalRecords = $this->paymentModel->where('user_id', $userId)->countAllResults(); // Total records
        $payments = $this->paymentModel->where('user_id', $userId)
                                       ->orderBy('payment_date', 'DESC')
                                       ->paginate($perPage, 'default', $page);

        $data = [
            'payments' => $payments,
            'pager' => $this->paymentModel->pager,
            'totalRecords' => $totalRecords
        ];

        return view('payment_history', $data);
    }


    // Method to handle user logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('user/login');
    }
	
	//////CHANGE PASSWORD 
	
	public function changePassword()
{
    // Check if user is logged in
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('user/login');
    }

    helper(['form']);

    if ($this->request->getMethod() == 'POST') {
        $rules = [
            'old_password'     => 'required|min_length[8]|max_length[255]',
            'new_password'     => 'required|min_length[8]|max_length[255]',
            'conf_new_password'=> 'matches[new_password]'
        ];

        if (!$this->validate($rules)) {
            return view('change_password', [
                'validation' => $this->validator
            ]);
        } else {
            $userModel = new UserModel();
            $userId = session()->get('id');
            $user = $userModel->find($userId);

            // Check if old password matches
            if (!password_verify($this->request->getVar('old_password'), $user['password'])) {
                return redirect()->to('user/change-password')->with('error', 'Old password is incorrect.');
            }

            // Update password
            $newPassword = password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT);
            $userModel->update($userId, ['password' => $newPassword]);

            return redirect()->to('user/change-password')->with('success', 'Password changed successfully.');
        }
    }

    return view('change_password');
}

	
	
	
	
	
	
}
