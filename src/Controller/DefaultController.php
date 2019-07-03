<?php

namespace App\Controller;

use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function index(MailService $mailService): Response
    {
        $mailService->sendMailWithAttachment();
        $mailService->sendMailWithoutAttachment();

        return $this->render('home.html.twig');
    }
}
