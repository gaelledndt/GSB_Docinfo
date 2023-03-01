<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
class ApiDashboardController extends AbstractController
{
    private UserPasswordHasherInterface $passwordHash;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHash = $passwordHasher;
    }
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
                             UserRepository $userRepository): Response
    {
        $credentials = json_decode($request->getContent(), true);
        $user = $userRepository->findOneBy(['email' => $credentials["username"]]);
        $password = $this->passwordHash->isPasswordValid(
            $user,
            $credentials['password']
        );
        if(isset($user) === false || $password === false){
            return new JsonResponse(json_encode(
                    [
                        "msg" => 'Invalid username or password',

                    ])
                ,Response::HTTP_BAD_REQUEST, [], true);
        }
        return new JsonResponse(json_encode(
                [
                    "user" => [
                        "id" => $user->getId(),
                        "email" => $user->getEmail(),
                        "role" => $user->getRole(),
                        "care_summary" => [
                            "firstname" => $user->getCareSummary()->getFirstname(),
                            "lastname" => $user->getCareSummary()->getLastname(),
                            "number_ss" => $user->getCareSummary()->getNumberSs(),
                            "birthday" => $user->getCareSummary()->getBirthday(),
                            "description" => $user->getCareSummary()->getDescription(),

                        ],
                        "doctor_referring" => $user->getCareSummary()->getDoctorReferring()->getEmail(),
                        "gender" => $user->getCareSummary()->getGender()->getType()
                    ],
                ])
            ,Response::HTTP_OK, [], true);
    }
}
