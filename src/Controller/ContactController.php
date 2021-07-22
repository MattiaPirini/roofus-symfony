<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */

    public function contact(Request $request, MailerInterface $mailer)
    {
        $contact_email = "info@roofus.it";

        $form = $this->createForm(ContactType::class);
        
        $form->handleRequest($request);

        

        if($form->isSubmitted() && $form->isValid()) {

            $contactFromData = $form->getData();

            $email = (new Email())
            ->from($contactFromData['email'])
            ->to('example@roofus.it')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('new subscription')
            ->text($contactFromData['message'])
            ->html($contactFromData['message']);

            $mailer->send($email);

            $this->addFlash('success', 'It sent!');

            return $this->redirectToRoute('contact');
        }

        return $this->render('pages/contact.html.twig', [
            'contact_email' => $contact_email,
            'contact_form' => $form->createView(),
        ]);


    }

}
