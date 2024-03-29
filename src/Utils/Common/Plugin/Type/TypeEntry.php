<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 05.08.2017
 * Time: 19:09
 */
namespace rohsyl\OmegaCore\Utils\Common\Plugin\Type;

/**
 * Class TypeEntry is used to implement TypeEntry for Form
 * @package rohsyl\OmegaCore\Utils\Common\Plugin\Type
 */
abstract class TypeEntry
{
    /**
     * @var string A uniq identifier key. This id must be used on your html code for exemple as an input name
     */
    private $_uniqId;

    /**
     * @var array The parameter of the entry
     */
    private $_param;

    /**
     * @var string The raw value of the entry
     */
    private $_value;

    /**
     * @var int|null The id of the page on which the entry is.
     */
    private $_idPage;

    /**
     * ATypeEntry constructor.
     * @param $uniqId
     * @param $param
     * @param $value
     * @param $idPage
     */
    public function __construct($uniqId, $param = null, $value = null, $idPage = null)
    {
        $this->_uniqId = $uniqId;
        $this->_param = $param;
        $this->_value = $value;
        $this->_idPage = $idPage;
    }

    /**
     * Get the uniqId
     * @return string The unid id
     */
    public function getUniqId(){
        return $this->_uniqId;
    }

    /**
     * Get param
     * @return array The param
     */
    protected function getParam(){
        return $this->_param;
    }

    /**
     * Get the raw value
     * @return string The raw value
     */
    protected function getValue(){
        return $this->_value;
    }

    /**
     * Get thu id of the page or null
     * @return int|null The id of the page
     */
    public function getIdPage(){
        return $this->_idPage;
    }

    /**
     * Check if the $key exists in $_POST
     * @param $key string The key
     * @return bool True if exists
     */
    protected function existsPost($key){
        return request()->has($key);
    }

    /**
     * Get the $key value in the $_POST
     * @param $key string The key
     * @return mixed
     */
    protected function getPost($key){
        if($this->existsPost($key))
            return request()->input($key);
        return null;
    }

    /**
     * This method must return the html form entry of the type, like an input.
     * @return mixed
     */
    public abstract function getHtml();

    /**
     * This method must return the value formatted in string and will be saved in the database
     * @return string The posted value
     */
    public abstract function getPostedValue();

    /**
     * This method must return the value as he will be used, like an object or anything else
     * @return mixed The object value
     */
    public abstract function getObjectValue();

    /**
     * Return the documentation html of the type
     * @return mixed
     */
    public abstract function getDoc();


}


//https://stackoverflow.com/questions/2410342/php-json-decode-returns-null-with-valid-json