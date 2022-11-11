<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class adminLoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // check if the alogged_in session is true and id is set
        if (!session()->has('admin') and !session()->get('alogged_in')) {
            return redirect('admin');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
