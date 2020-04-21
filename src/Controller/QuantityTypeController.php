<?php


namespace App\Controller;


use App\Entity\QuantityType;
use App\Repository\QuantityTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuantityTypeController extends AbstractController
{
    /**
     * @Route("/quantity-types", name="app_get_all_quantity_types", methods={"GET"})
     * @param QuantityTypeRepository $quantityTypeRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAllQuantityTypes(QuantityTypeRepository $quantityTypeRepository, SerializerInterface $serializer)
    {
        $quantityTypes = $quantityTypeRepository->findAll();
        return new JsonResponse(json_decode($serializer->serialize($quantityTypes, 'json', ['groups' => 'group_quantity_type'])));
    }
}