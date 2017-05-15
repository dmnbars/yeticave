<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use AppBundle\Entity\Lot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Наименование'])
            ->add(
                'category',
                EntityType::class,
                [
                    'placeholder' => 'Выберите категорию',
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'label' => 'Категория'
                ]
            )
            ->add('description', null, ['label' => 'Описание'])
            ->add('image', FileType::class, ['label' => 'Изображение'])
            ->add('startPrice', null, ['label' => 'Начальная цена'])
            ->add('betStep', null, ['label' => 'Шаг ставки'])
            ->add(
                'dateComplete',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'format' => 'dd.MM.yyyy',
                    'label' => 'Дата заверщения',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lot::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_lot_type';
    }
}
