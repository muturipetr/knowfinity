<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
#[Route('/contact', name: 'app_contact')]
public function index(Request $request, MailerInterface $mailer): Response
{
    $form = $this->createForm(ContactType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
    $data = $form->getData();
    $email = (new Email())
    ->from($data['email'])
    ->to('pinchezman5@gmail.com')
    ->subject('New Contact Message')
    ->text($data['message']);

    $mailer->send($email);
    $this->addFlash('success', 'Message sent successfully!');

    return $this->redirectToRoute('app_contact');
    }

    return $this->render('contact/index.html.twig', [
    'contact_form' => $form->createView(),
    ]);
    }
}