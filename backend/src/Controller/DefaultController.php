<?php

namespace App\Controller;

use Exception;
use TypeError;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\Interfaces\LuhnChecksumInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\LuhnChecksumException;


class DefaultController extends AbstractController
{
    /**  @var LuhnChecksumInterface */
    private $service;

    public function __construct(LuhnChecksumInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Run the Luhn Checksum algorithm on the user-provided number
     *
     * @param string $subject
     * @return Response
     */
    public function index(string $subject): Response
    {
        $headers = ['Content-type' => 'text/html'];
        $status = Response::HTTP_OK;
        try {
            $isValid = $this->service->handle($subject);
            $response = $subject . ' is ' . (($isValid) ? '' : 'not') . ' valid.';
        } catch (TypeError $ex) {
            $response = $ex->getMessage();
        } catch (LuhnChecksumException $ex) {
            $response = $ex->getMessage();
            $status = Response::HTTP_UNPROCESSABLE_ENTITY;
        } catch (Exception $ex) {
            $response = $ex->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return new Response($response, $status, $headers);
    }
}