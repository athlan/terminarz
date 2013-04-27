<?php

namespace Application\Util;

/**
 * This class represents global registry.
 * 
 * @author Athan
 *
 */
class Registry {
    protected static $instance = null;
    
    protected $storage = [];
    
    protected function __constryct() {}
    protected function __clone() {}
    
    /**
     * @return \Application\Util\Registry
     */
    public static function getInstance() {
        if(!self::$instance instanceof self)
            self::$instance = new self();
        
        return self::$instance;
    }
    
    /**
     * Checks if entry exists in regisry.
     * 
     * @param string $key
     * @return boolean
     */
    public function is($key) {
        $this->assertKey($key);
        
        return isset($this->storage[$key]);
    }
    
    /**
     * Gets the registry item.
     * 
     * @param string $key
     * @return mixed
     */
    public function get($key) {
        $this->assertKey($key);
        
        if(!$this->is($key))
            throw new \Exception("There no entry uner key '" . $key . "'");
        
        return $this->storage[$key];
    }
    
    /**
     * Sets the registry item.
     *
     * @param string $key
     * @param mixed $val
     * @return mixed
     */
    public function set($key, $val) {
        $this->assertKey($key);
    
        $this->storage[$key] = $val;
    }
    
    /**
     * Deletes the registry item.
     *
     * @param string $key
     * @param mixed $val
     * @return mixed
     */
    public function delete($key) {
        $this->assertKey($key);
        
        unset($this->storage[$key]);
    }
    
    public function assertKey($key) {
        if(!is_string($key))
            throw new \Exception("Key must be a string.");
        
        return true;
    }
}
