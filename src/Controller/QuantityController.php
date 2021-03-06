<?php


namespace App\Controller;

use App\Entity\Quantity;
use App\Repository\QuantityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/quantities/{quantity_id}", name="app_get_one_quantity", requirements={"quantity_id": "\d+"}, methods={"GET"})
     * @ParamConverter("quantity", options={"id" = "quantity_id"})
     * @param Quantity $quantity
     * @return JsonResponse
     */
    public function getOne(Quantity $quantity)
    {
        return $this->response($quantity, Quantity::GROUP_QUANTITY);
    }
}