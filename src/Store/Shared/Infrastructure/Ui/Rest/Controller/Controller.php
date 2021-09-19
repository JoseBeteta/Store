<?php
declare(strict_types=1);

namespace App\Store\Shared\Infrastructure\Ui\Rest\Controller;

use App\Store\Shared\Application\QueryBus\Query;
use ShoppingCart\Common\Types\Infrastructure\Ui\Http\Rest\Exception\BadFormatException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class Controller extends AbstractController
{
    /**
     * @var MessageBusInterface
     */
    protected $queryBus;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * Controller constructor.
     * @param MessageBusInterface $queryBus
     */
    public function __construct(MessageBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
        $this->validator = Validation::createValidator();
    }

    /**
     * @param array|null $response
     * @return JsonResponse
     */
    public function buildResponseForOk(array $response = null): JsonResponse
    {
        return new JsonResponse(
            $response !== null ? json_encode($response) : '',
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    public function dispatchQuery(Query $query)
    {
        $envelope = $this->queryBus->dispatch($query);
        /** @var HandledStamp $handled */
        $handled = $envelope->last(HandledStamp::class);

        return $handled->getResult();
    }

    /**
     * @param Assert\Collection $constraintCollection
     * @param array $contract
     * @throws BadFormatException
     */
    public function validate(Assert\Collection $constraintCollection, array $contract)
    {
        $violations = $this->validator->validate($contract, $constraintCollection);
        if ($violations->count() > 0) {
            throw new BadFormatException($violations->get(0));
        }
    }
}
