<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('picture', TextType::class, [
                'label' => 'Picture',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Price',
            ])
            ->add('rate', IntegerType::class, [
                'label' => 'Rate',
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Status',
                'choices'  => [
                'Unknown' => 0,
                'Available' => 1,
                'Unavailable' => 2,
            ],
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'label' => 'Brand',
                'choice_label' => 'name',
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'label' => 'Type',
                'choice_label' => 'name',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Category',
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
