<?php

namespace App\Form;

use App\Entity\SharedPlaylist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SharedPlaylistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //dump($options);
        $sharedPlaylist = $options['data'] ?? null;
        $member = $sharedPlaylist->getCreator();
        $builder
            ->add('description')
            ->add('published')
            ->add('creator', null, [
                'disabled'   => true, ])
            ->add('musics')
            ->add('musics', null, [
                'query_builder' => function (MusicRepository $er) use ($membre) {
                        return $er->createQueryBuilder('g')
                        ->leftJoin('g.playlist', 'i')
                        ->andWhere('i.owner = :membre')
                        ->setParameter('membre', $membre)
                        ;
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SharedPlaylist::class,
        ]);
    }
}
