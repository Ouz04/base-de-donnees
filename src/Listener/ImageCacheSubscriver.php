<?php

namespace App\Listener;

use App\Entity\Tarticle;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber
{

    private $cacheManager;

    private $uploadrhelper;

    public function __construct(CacheManager $cacheManager, UploaderHelper $uploadrhelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploadrhelper = $uploadrhelper;
    }
    public function getSubscribedEvents()
    {
        return [
            'preRemove',
            'preUpdate',
        ];
    }
    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Tarticle) {
            return;
        }
        $this->cacheManager->remove($this->uploadrhelper->asset($entity, 'img2)'));
    }
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Tarticle) {
            return;
        }
        if ($entity->getImg2() instanceof UploadedFile) {
            //       $this->cacheManager->remove($this->uploadrhelper->asset($entity, 'img2)'));
        }
        dump($args->getEntity());
    }
}
