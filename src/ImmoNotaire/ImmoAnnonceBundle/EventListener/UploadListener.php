<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ImmoNotaire\ImmoAnnonceBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Photo;
use ImmoNotaire\ImmoAnnonceBundle\Uploader\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

class UploadListener {

    private $uploader;

    public function __construct(FileUploader $uploader) {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args) {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity) {
        // upload only works for Product entities
        if (!$entity instanceof Photo || $entity == null) {
            return;
        }

        $file = $entity->getImg();

        // only upload new files
        if (!$file instanceof UploadedFile || $file == null || $file == "") {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setImg($fileName);
    }
    
     public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Product) {
            return;
        }

        if ($fileName = $entity->getImg()) {
            $entity->setImg(new File($this->uploader->getTargetDir().'/'.$fileName));
        }
    }

}
