<?php

namespace App\Form;

use App\Entity\BlogArticleEntity;
use App\Entity\BlogCategoriesEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogArticleEditType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('category', EntityType::class, [
                'class' => BlogCategoriesEntity::class,
                'choice_label' => 'title',
                'attr' => ['class' => 'form-control']
            ])
            ->add('date', DateTimeType::class, [
                'placeholder' => 'Wybierz datę',
                'date_widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('wyrozniony', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'data-plugin' => 'switchery',
                    'data-color' => '#3db9dc',
                    'data-switchery' => true,
                    'style' => 'display:none;'
                ],
                'required' => false,
            ]);
        $builder->get('wyrozniony')
            ->addModelTransformer(new CallbackTransformer(
                function ($activeAsString) {
                    // transform the string to boolean
                    return (bool)(int)$activeAsString;
                },
                function ($activeAsBoolean) {
                    // transform the boolean to string
                    return (string)(int)$activeAsBoolean;
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BlogArticleEntity::class,
        ));
    }
}