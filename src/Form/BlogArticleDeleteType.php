<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class BlogArticleDeleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('confirmthis',CheckboxType::class, array(
                'attr' => [
                    'class' => 'form-control',
                    'data-plugin' => 'switchery',
                    'data-color' => '#3db9dc',
                    'data-switchery' => true,
                    'style' =>'display:none;'
                ],
                'required' => false,
            ));
    }

}