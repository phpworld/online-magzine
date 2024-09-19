<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{ 
    public function before(RequestInterface $request, $arguments = null)
    {
         $session = session();
        if (!$session->has('isAdminLoggedIn')) {
            // Not logged in, redirect to the login page
            return redirect()->to('admin/login')->with('error', 'You must be logged in as an admin to access this page.');
        }

    }
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
