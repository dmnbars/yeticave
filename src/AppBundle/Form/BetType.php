<?php

namespace AppBundle\Form;

use AppBundle\Entity\Bet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('amount', null, ['label' => 'Ваша ставка']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bet::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_bet_type';
    }
}
