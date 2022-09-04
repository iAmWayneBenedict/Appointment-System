<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class userLoginFilter implements FilterInterface 
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // check if the logged_in session is true and id is set
        if (!session()->get('logged_in') and session()->has('id')){
            return redirect('user/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}