<?php

namespace App\Controller;

use App\Repository\AllergenicRepository;
use App\Repository\HealthStatusRepository;
use App\Repository\UserRepository;
use ContainerBuZe7gi\getPrescriptionMedicationCrudControllerService;
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
                             UserRepository $userRepository, AllergenicRepository $allergenicRepository): JsonResponse
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
        $healthStatus = [];
        $prescriptions = [];
        $prescriptionMedications = [];
        $allergenic = [];

        foreach ($user->getCareSummary()->getHealthStatuses() as $value){
            $healthStatus[] = [
                "disease" => $value->getDisease(),
                "description" => $value->getDescription(),
                "status" => $value->getStatus()->getStatus(),
            ];
        }
        foreach ($user->getCareSummary()->getPrescriptions() as $value){
            $prescriptions[] = [
                "beginDate" => $value->getCreatedAt(),
                "endDate" => $value->getEndDate(),
            ];
            foreach ($value->getPrescriptionMedications() as $valuePm){
                $prescriptionMedications[] = [
                    "medication" => $valuePm->getMedication(),
                    "description" => $valuePm->getDescription(),
                    "beginDate" => $valuePm->getCreatedAt(),
                    "endDate" => $valuePm->getEndMedication(),
                ];
            }
        }

        foreach ($user->getCareSummary()->getAllergenic() as $value){
            $allergenic[] = [
                "name" =>$value->getName(),
            ];
        }

     /*   foreach ($user->getCareSummary()->getAllergenic() as $value){
            $allergenic[] = [
                "disease" => $value->getDisease(),
                "description" => $value->getDescription(),
                "status" => $value->getStatus()->getStatus(),
            ];
        }*/
        //dd($user->getCareSummary()->getPrescriptions()[0]->getPrescriptionMedications()[0]);
        //dd($user->getCareSummary()->getAllergenic());
       // dd($allergenic);
        return new JsonResponse(json_encode(
                [
                    "user" => [
                        "id" => $user->getId(),
                        "email" => $user->getEmail(),
                        "role" => $user->getRole(),
                        "careSummary" => [
                            "firstname" => $user->getCareSummary()->getFirstname(),
                            "lastname" => $user->getCareSummary()->getLastname(),
                            "numberSs" => $user->getCareSummary()->getNumberSs(),
                            "birthday" => $user->getCareSummary()->getBirthday(),
                            "description" => $user->getCareSummary()->getDescription(),

                        ],
                        "doctorReferring" => $user->getCareSummary()->getDoctorReferring()->getEmail(),
                        "gender" => $user->getCareSummary()->getGender()->getType(),
                        "healthStatus" => $healthStatus,
                        "prescriptions" => $prescriptions,
                        "prescriptionMedication" => $prescriptionMedications,
                        "allergenic" =>$allergenic
                    ],
                ])
            ,Response::HTTP_OK, [], true);
    }
}
