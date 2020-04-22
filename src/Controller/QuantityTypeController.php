<?php


namespace App\Controller;


use App\Entity\QuantityType;
use App\Repository\QuantityTypeRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuantityTypeController extends BaseController
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

    /**
     * @Route("/quantity-types", name="app_post_quantity_types", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param QuantityTypeRepository $quantityTypeRepository
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request, SerializerInterface $serializer, QuantityTypeRepository $quantityTypeRepository)
    {
        $content = $request->getContent();
        /** @var QuantityType $quantityType */
        $quantityType = $serializer->deserialize($content, QuantityType::Class, 'json', ['groups' => 'group_quantity_type']);
        $quantityTypeRepository->create($quantityType);
        return new JsonResponse(json_decode($serializer->serialize($quantityType, 'json', ['groups' => 'group_quantity_type'])));
    }
}