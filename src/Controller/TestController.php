<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    #[Route(path: '/api/test', methods: ['GET'])]
    public function test(Request $request): Response
    {
        return new Response("Hello world");
    }
}
