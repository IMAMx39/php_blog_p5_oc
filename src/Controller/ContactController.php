<?php

namespace App\Controller;

use Core\Controller;
use Core\Form\Field\Input;
use Core\Form\Field\Textarea;
use Core\Form\Field\Email as InputEmail;
use Core\Form\FormBuilder;
use Core\Mailer\Mailer;
use Core\Request;
use Core\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;


class ContactController extends Controller
{

    public function contact(Request $request): Response
    {

        $formContact = new FormBuilder('POST');

        $formContact
            ->add(
                (new Input('username', ['id' => 'username', 'class' => 'form-control']))
                    ->withLabel('Nom et Prénom')
            )->add(
                (new InputEmail('email', ['id' => 'email', 'class' => 'form-control']))
                    ->withLabel('Email')
            )->add(
                (new Textarea('subject', ['id' => 'subject', 'class' => ' form-control']))
                    ->withLabel('Votre message')
            );

        if ($formContact->handleRequest($request)->isSubmitted() && $formContact->isValid()) {

            $username = $request->post('username');
            $email = $request->post('email');
            $subject = $request->post('subject');

            $this->sendMailContact($username, $email, $subject);

            return $this->render('contact',[
                "form" => $formContact
            ]);
        }

        return $this->render('contact', [
            "form" => $formContact
        ]);
    }

    /**
     * @throws TransportExceptionInterface
     */
    private function sendMailContact(string $username , string $email , string $subject): void
    {
        $transport = Transport::fromDsn(Mailer::getMailerDsn('mailer_dsn'));
        $mailer = new \Symfony\Component\Mailer\Mailer($transport);
        $data = [
            'name' => $username,
            'email' => $email,
            'message' => htmlspecialchars_decode($subject)
        ];

        $mail = (new Email())
            ->from($email)
            ->to('imaassou@gmail.com')
            ->subject('[Amazing Blog - Contact] : '.$username)
            ->text('Vous avez reçu un email de la part de : '.$username.' ('.$email.') -> '.$subject)
            ->html($this->renderHTML('mail_contact',$data));

        $mailer->send($mail);
    }

    private function displaySuccess(string $username) : Response
    {
        $data = [
            'name' => $username,
        ];

        return $this->render('contact', $data);
    }

}