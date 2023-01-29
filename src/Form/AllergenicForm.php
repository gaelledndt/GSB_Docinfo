<?php

namespace App\Form;

use App\Entity\Allergenic;
use App\Entity\Attachment;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AllergenicForm extends AbstractType
{
    private ObjectManager $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name', ChoiceType::class, [
                'choices' => [
                    "Acariens" => "23",
                    "Chat" => "25",
                    "Noix" => "29"],])
        ;
    }




    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Allergenic::class,
        ]);
    }
    private function getChoices()
    {
        $allergenic = $this->manager->getRepository(Allergenic::class)->findAll();
        $choices = [];
        foreach ($allergenic as $option) {
            $choices[$option->getName()] = $option->getId();
        }

        return $choices;
    }
}
