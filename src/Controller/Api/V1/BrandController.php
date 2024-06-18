<?php

namespace App\Controller\Api\V1;

use App\Repository\BrandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/brand', name: 'app_api_v1_brand_')]
class BrandController extends AbstractController
{
    #[Route('/', name: 'browse')]
    public function browse(BrandRepository $brandRepository): JsonResponse
    {
        return $this->json($brandRepository->findAll(), 200, [], ['groups' => 'product_browse']);
    }
}
