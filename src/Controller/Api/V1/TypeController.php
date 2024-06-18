<?php

namespace App\Controller\Api\V1;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Doctrine\DBAL\Types\TypeRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/type', name: 'app_api_v1_type_')]
class TypeController extends AbstractController
{
    #[Route('/', name: 'browse')]
    public function browse(TypeRepository $typeRepository): JsonResponse
    {
        return $this->json($typeRepository->findAll(), 200, [], ['groups' => 'product_browse']);
    }


    #[Route('/{id}', name: 'products', methods: ["GET"], requirements: ["id" => "\d+"])]
    public function products(Type $type): JsonResponse
    {
        return $this->json($type->getProducts(), 200, [], ['groups' => 'product_browse']);
    }
}
