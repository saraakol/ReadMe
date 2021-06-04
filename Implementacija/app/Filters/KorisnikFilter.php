<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class KorisnikFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {   
        $args=explode($_SERVER["REQUEST_URI"],"/");
        if(!$args[count($args)-1]=="logout")
        {
            if (session()->get('korisnik') == null) {
                return redirect()->to(site_url('Gost'));
            } else if (session()->get('korisnik')->getType() == 'administrator') {
                return redirect()->to(site_url('Administrator'));
            } else if (session()->get('korisnik')->getType() == 'privileged_user') {
                return redirect()->to(site_url('Privilegovani'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}