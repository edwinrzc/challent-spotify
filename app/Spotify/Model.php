<?php
namespace App\Spotify;


abstract class Model
{
    
    protected $attributes = [];
    
    
    public function __construct(array $attributes = [])
    {        
        $this->fill($attributes);        
    }
    
    
    public function fill(array $attributes = [])
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }
    
    
    public function getAttribute($name)
    {
        $value = $this->getAttributevalue($name);
        
        if($this->hasGetMutator($name)){
            return $this->mutateAttribute($name, $value);
        }
        
        return $value;
    }
    
    
    protected function mutateAttribute($name, $value){
        
       return $this->{'get'.Str::studly($name)}($value);
    }
    
    
    protected function hasGetMutator($name)
    {
        return method_exists($this, 'get'.Str::studly($name));
    }
    
    
    public function getAttributevalue( $name ){
        
        if(array_key_exists($name, $this->attributes)){
            return $this->attributes[$name];
        }
    }
    
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    public function __get($name)
    {
        
        return $this->getAttribute($name);
    }
    
    
    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }
    
    public function __set($name, $value)
    {
        $this->setAttribute($name, $value);
    }
    
    
    public function hasAttribute($name)
    {
        return isset($this->attributes[$name]);
    }
    
    
    public function __isset($name)
    {
        return $this->hasAttribute($name);
    }
    
    
    public function __unset( $name )
    {
        unset ($this->attributes[$name]);
    }
}
