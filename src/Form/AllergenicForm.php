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
use function Symfony\Component\Translation\t;

class AllergenicForm extends AbstractType
{
    private ObjectManager $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $choices = ['Option 1', 'Option 2', 'Option 3'];
        $builder
            ->add('name', ChoiceType::class, [
                'choices' => $choices,
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Allergenic::class,
        ]);
    }
    private function getChoices(): array
    {
        $allergenic = $this->manager->getRepository(Allergenic::class)->findAll();
        $choices = [];
        foreach ($allergenic as $option) {
            $choices[$option->getName()] = $option->getId();
        }

        return $choices;
    }
}
