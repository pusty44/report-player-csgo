<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 13.08.2018
 * Time: 23:31
 */

namespace App\Form;

use App\Entity\BlogArticleEntity;
use App\Entity\BlogCategoriesEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogArticle extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('content', TextareaType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('image',FileType::class,array(
                'data_class' => null,
                'required' => false,
                'attr' => array('class' => 'form-control', 'required' => false)
            ))
            ->add('category',EntityType::class, array(
                'class' => BlogCategoriesEntity::class,
                'choice_label' => 'title',
                'attr' => array('class' => 'form-control')
                ))
            ->add('date',DateTimeType::class, array(
                'placeholder' => 'Wybierz datę',
                'date_widget' => 'single_text',
                'attr' => array('class' => 'form-control')
            ))
            ->add('wyrozniony',CheckboxType::class, array(
                'attr' => array('class' => 'form-control', 'data-plugin' => 'switchery', 'data-color' => '#3db9dc', 'data-switchery' => true, 'style' =>'display:none;'),
                'required' => false,
            ));
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