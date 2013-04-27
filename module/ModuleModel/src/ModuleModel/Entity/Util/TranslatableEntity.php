<?php

namespace ModuleModel\Entity\Util;

use ModuleModel\Entity\Util\AbstractEntity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * A dictionary entry.
 * 
 * @ORM\MappedSuperclass 
 */
abstract class TranslatableEntity extends AbstractEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * @ORM\Column(type="string");
     */
    protected $language;
    
    /**
     * @var string
     * @ORM\Column(type="string");
     */
    protected $value;
    
    /**
     * Provides creation for new empty entity.
     * 
     */
    public function __construct($owner, $language, $value)
    {
        $this->setOwner($owner);
        
        $this->setLanguage($language);
        
        $this->setValue($value);
    }
    
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function populate($data = array()) 
    {
        if(isset($data['id'])) {
            $this->setId($data['id']);
        }
        
        if($data['value']) {
            $this->setValue($data['value']);
        }
    }
    
	/**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    protected function setId($id) {
        $this->id = $id;
    }
    
    protected abstract function setOwner($owner);
    
    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }
    
    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->getLanguage();
    }
    
    /**
     * @param string $language
     */
    private function setLanguage($language)
    {
        $this->language = $language;
    }
    
	/**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
    
	/**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public static function getValueLocalized(array $values, $lang = null)
    {
        $name = '';
        
        if(null === $lang)
            $lang = \Locale::getDefault();
        
        foreach ($values as $translation) {
            if($translation instanceof TranslatableEntity) {
                if($translation->getLanguage() == $lang) {
                    return $translation->getValue();
                }
            }
        }
        
        return '';
    }
}
