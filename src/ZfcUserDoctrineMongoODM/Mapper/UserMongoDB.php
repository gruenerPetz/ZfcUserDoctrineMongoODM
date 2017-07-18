<?php

namespace ZfcUserDoctrineMongoODM\Mapper;

use Doctrine\ODM\MongoDB\DocumentManager;
use ZfcUser\Entity\UserInterface;
use ZfcUserDoctrineMongoODM\Options\ModuleOptions;

class UserMongoDB implements \ZfcUser\Mapper\UserInterface
{
    /**
     * @var DocumentManager
     */
    protected $documentManager;


    /**
     * @var \ZfcUserDoctrineMongoODM\Options\ModuleOptions
     */
    protected $options;


    /**
     * UserMongoDB constructor.
     *
     * @param DocumentManager $documentManager
     * @param ModuleOptions $options
     */
    public function __construct(DocumentManager $documentManager, ModuleOptions $options)
    {
        $this->setDocumentManager($documentManager);
        $this->setOptions($options);
    }


    public function findByEmail($email)
    {
        $user = $this->getUserRepository()->findOneBy(['email' => $email]);

        return $user;
    }


    public function findByUsername($username)
    {
        $user = $this->getUserRepository()->findOneBy(['username' => $username]);

        return $user;
    }


    public function findById($id)
    {
        $user = $this->getUserRepository()->findOneBy(['id' => $id]);

        return $user;
    }


    /**
     * @return DocumentManager
     */
    public function getDocumentManager()
    {
        return $this->documentManager;
    }


    /**
     * @param DocumentManager $documentManager
     */
    public function setDocumentManager(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }


    /**
     * @return ModuleOptions
     */
    public function getOptions()
    {
        return $this->options;
    }


    /**
     * @param ModuleOptions $options
     */
    public function setOptions(ModuleOptions $options)
    {
        $this->options = $options;
    }


    /**
     * @return \Doctrine\ODM\MongoDB\DocumentRepository
     */
    public function getUserRepository()
    {
        $class = $this->getOptions()->getUserEntityClass();

        return $this->getDocumentManager()->getRepository($class);
    }


    /**
     * @param $document
     */
    public function persist($document)
    {
        $this->getDocumentManager()->persist($document);
        $this->getDocumentManager()->flush();
    }


    /**
     * @param UserInterface $document
     */
    public function insert(UserInterface $document)
    {
        $this->persist($document);
    }


    /**
     * @param UserInterface $document
     */
    public function update(UserInterface $document)
    {
        $this->persist($document);
    }
}
