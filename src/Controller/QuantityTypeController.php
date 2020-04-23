<?php


namespace App\Controller;


use App\Entity\QuantityType;
use App\Repository\QuantityTypeRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuantityTypeController extends BaseController
{
    /** @var QuantityTypeRepository */
    private QuantityTypeRepository $quantityTypeRepository;

    /**
     * RecipeController constructor.
     * @param QuantityTypeRepository $quantityTypeRepository
     * @param SerializerInterface $serialize
     */
    public function __construct(QuantityTypeRepository $quantityTypeRepository, SerializerInterface $serialize)
    {
        parent::__construct($serialize);
        $this->quantityTypeRepository = $quantityTypeRepository;
    }

    /**
     * @Route("/quantity-types", name="app_get_all_quantity_types", methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $quantityTypes = $this->quantityTypeRepository->findAll();

        return $this->response($quantityTypes, QuantityType::GROUP_QUANTITY_TYPE);
    }

    /**
     * @Route("/quantity-type", name="app_get_one_quantity_type", methods={"GET"})
     * @return JsonResponse
     */
    public function getOne()
    {
        $quantityType = $this->quantityTypeRepository->findOneBy(['id' => '130']);

        return $this->response($quantityType, QuantityType::GROUP_QUANTITY_TYPE);
    }
    /**
     * @Route("/quantity-types", name="app_post_quantity_types", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request)
    {
        /** @var QuantityType $quantityType */
        $quantityType = $this->handleRequest(QuantityType::class, QuantityType::GROUP_QUANTITY_TYPE, $request);

        return $this->response($this->quantityTypeRepository->create($quantityType), QuantityType::GROUP_QUANTITY_TYPE);
    }
}