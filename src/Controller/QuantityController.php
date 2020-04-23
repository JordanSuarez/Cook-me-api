<?php


namespace App\Controller;


use App\Entity\Ingredient;
use App\Entity\Quantity;
use App\Repository\QuantityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuantityController extends BaseController
{
    /**@var QuantityRepository */
    private QuantityRepository $quantityRepository;

    public function __construct(QuantityRepository $quantityRepository, SerializerInterface $serialize)
    {
        parent::__construct($serialize);
        $this->quantityRepository = $quantityRepository;
    }

    /**
     * @Route("/quantities", name="app_get_all_quantities", methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $quantities = $this->quantityRepository->findAll();

        return $this->response($quantities, Quantity::GROUP_QUANTITY);
    }

    /**
     * @Route("/quantity", name="app_get_one_quantity", methods={"GET"})
     * @return JsonResponse
     */
    public function getOne()
    {
        $quantity = $this->quantityRepository->findOneBy(['number' => '2']);

        return $this->response($quantity, Quantity::GROUP_QUANTITY);
    }
    /**
     * @Route("/quantities", name="app_post_quantities", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request)
    {
        /** @var Quantity $quantity */
        $quantity = $this->handleRequest(Quantity::class, Quantity::GROUP_QUANTITY, $request);

        return $this->response($this->quantityRepository->create($quantity), QUantity::GROUP_QUANTITY);
    }
}