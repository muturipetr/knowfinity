<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
    ->add('name', TextType::class, ['label' => 'Your Name'])
    ->add('email', EmailType::class, ['label' => 'Your Email'])
    ->add('message', TextareaType::class, ['label' => 'Message'])
    ->add('submit', SubmitType::class, ['label' => 'Send Message']);
    }
}