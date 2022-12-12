<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class maintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        foreach (getenv() as $key => $value) {
            if ($key !== "CI_STATUS") continue;
            if ($value === "maintenance") return redirect('maintenance');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
