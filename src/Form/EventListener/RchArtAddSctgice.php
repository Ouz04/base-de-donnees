<?php

namespace App\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RchArtAddSctgice implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.

        return [FormEvents::POST_SET_DATA => 'postSetData'];
    }

    public function preSetData(FormEvent $event): void
    {

        $tcategorie = $event->getData();
        $form = $event->getForm();

        // if (!$tcategorie || null === $tcategorie->getId()) {
        if (!$tcategorie) {
            dd("preSetData");
            dd($event);
            $form->add('tsctgice', TextType::class);
        }
    }
    public function postSetData(FormEvent $event): void
    {

        $tcategorie = $event->getData();
        $form = $event->getForm();


        // if (!$tcategorie || null === $tcategorie->getId()) {
        if (!$tcategorie) {
            dd($event);
            $form->add('tsctgice', TextType::class);
        }
    }
}
