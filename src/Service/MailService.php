<?php

namespace App\Service;

use Knp\Snappy\Pdf;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailService
{
    private $fileName = 'helloworld.pdf';

    /**
     * @var Environment
     */
    private $engine;

    /**
     * @var Pdf
     */
    private $generator;

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * MailService constructor.
     *
     * @param Environment $engine
     * @param Pdf $generator
     * @param MailerInterface $mailer
     */
    public function __construct(Environment $engine, Pdf $generator, MailerInterface $mailer)
    {
        $this->engine = $engine;
        $this->generator = $generator;
        $this->mailer = $mailer;
    }

    public function sendMailWithAttachment(): void
    {
        $this->generator->generateFromHtml($this->engine->render('attachment.html.twig'), $this->fileName, [], true);
        $message = $this->createBaseMessage('With attachment');
        $message->attachFromPath($this->fileName, 'Test.pdf', 'application/pdf');

        $this->mailer->send($message);
    }

    public function sendMailWithoutAttachment(): void
    {
        $this->mailer->send($this->createBaseMessage('Without attachment'));
    }

    private function createBaseMessage(string $title): Email
    {
        $message = (new TemplatedEmail())
            ->subject($title)
            ->from('ruben6jacobs@gmail.com')
            ->to('hello.world@symfony.com')
            ->htmlTemplate('mail.html.twig')
            ->context(['page_title' => $title]);

        return $message;
    }
}
