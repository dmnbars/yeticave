<?php
/**
 * Created by PhpStorm.
 * User: dmnbars
 * Date: 12/05/2017
 * Time: 11:27
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\User;
use AppBundle\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AvatarUploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        if (!$entity instanceof User) {
            return;
        }

        $file = $entity->getAvatar();

        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setAvatar($fileName);
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof User) {
            return;
        }

        if ($fileName = $entity->getAvatar()) {
            $entity->setAvatar(new File($this->uploader->getTargetDir() . '/' . $fileName));
        }
    }
}
