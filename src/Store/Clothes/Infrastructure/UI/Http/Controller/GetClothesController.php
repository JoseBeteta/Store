<?php
declare(strict_types=1);

namespace App\Store\Clothes\Infrastructure\UI\Http\Controller;

use App\Store\Clothes\Application\DTO\ClothResponseCollection;
use App\Store\Clothes\Application\Query\GetClothesWithDiscountsAppliedQuery;
use Symfony\Component\Validator\Constraints as Assert;
use App\Store\Shared\Infrastructure\Ui\Rest\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetClothesController extends Controller
{
    /**
     * @Route("/get", name="get_discounts", methods={"GET"})
     */
    public function getClothesAction(Request $request): JsonResponse
    {
        $data = $request->query->all();
        $this->validateRequest($data ?? []);

        /** @var ClothResponseCollection $clothesResponse */
        $clothesResponse = $this->dispatchQuery(
            new GetClothesWithDiscountsAppliedQuery(
                $data['category'],
                isset($data['priceLessThan']) ? (int) $data['priceLessThan'] : null
            )
        );

        return $this->buildResponseForOk($clothesResponse->toArray());
    }


    private function validateRequest(array $data)
    {
        $contractConstraint = new Assert\Collection([
            'category' => new Assert\NotBlank(),
            'priceLessThan' => new Assert\Optional()
        ]);

        $this->validate($contractConstraint, $data);
    }
}
