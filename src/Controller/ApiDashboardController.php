<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class ApiDashboardController extends AbstractController
{
    #[Route('/api', name: 'app_api_dashboard')]
    public function index(): Response
    {
        return new JsonResponse(json_encode([
                "msg" => "tr"
            ])
            ,Response::HTTP_OK, [], true);
    }
    #[Route('/api/login', name: 'app_api_dashboard_login', methods: ["POST"])]
    public function apiLogin(Request $request,
                             UserRepository $userRepository, ): Response
    {
        $credentials = json_decode($request->getContent(), true);
        $user = $userRepository->findOneBy(['email' => $credentials["username"]]);
        if(isset($user) === false){
            return new JsonResponse(json_encode(
                    [
                        "msg" => 'Invalid username or password',

                    ])
                ,Response::HTTP_BAD_REQUEST, [], true);
        }
        return new JsonResponse(json_encode(
                [
                    "user" => $credentials,

                ])
            ,Response::HTTP_OK, [], true);
    }
}
