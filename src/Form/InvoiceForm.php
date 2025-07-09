<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Invoice;
use App\Entity\Quote;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_created')
            ->add('due_date')
            ->add('status')
            ->add('total_ht')
            ->add('total_ttc')
            ->add('total_tva')
            ->add('client_id', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'name',
            ])
            ->add('quote_id', EntityType::class, [
                'class' => Quote::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
