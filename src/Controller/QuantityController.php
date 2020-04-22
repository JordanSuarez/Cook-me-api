<?php


namespace App\Controller;


use App\Entity\Quantity;
use App\Repository\QuantityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuantityController extends BaseController
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

    /**
     * @Route("/quantities", name="app_post_quantities", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param QuantityRepository $quantityRepository
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request, SerializerInterface $serializer, QuantityRepository $quantityRepository)
    {
        $content = $request->getContent();
        /** @var Quantity $quantity */
        $quantity = $serializer->deserialize($content, Quantity::Class, 'json', ['groups' => 'group_quantity']);
        $quantityRepository->create($quantity);
        return new JsonResponse(json_decode($serializer->serialize($quantity, 'json', ['groups' => 'group_quantity'])));
    }
}