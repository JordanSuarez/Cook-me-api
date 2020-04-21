<?php


namespace App\Controller;


use App\Repository\QuantityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuantityController extends AbstractController
{
    /**
     * @Route("/quantities", name="app_get_all_quantities", methods={"GET"})
     * @param QuantityRepository $quantityRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAllRecipeType(QuantityRepository $quantityRepository, SerializerInterface $serializer)
    {
        $quantities = $quantityRepository->findAll();
        return new JsonResponse(json_decode($serializer->serialize($quantities, 'json', ['groups' => 'group_quantity'])));
    }
}