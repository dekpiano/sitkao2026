<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    public string $clientId     = '';
    public string $clientSecret = '';
    public string $redirectUri  = '';

    public function __construct()
    {
        parent::__construct();
        $this->clientId     = env('GOOGLE_CLIENT_ID', '29638025169-aeobhq04v0lvimcjd27osmhlpua380gl.apps.googleusercontent.com');
        $this->clientSecret = env('GOOGLE_CLIENT_SECRET', 'RSANANTRl84lnYm54Hi0icGa');
        $this->redirectUri  = base_url('admin/googleCallback');
    }
}
