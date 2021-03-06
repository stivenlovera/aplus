<?php

/**
 * Zt (http://www.zootemplate.com/zo2)
 * A powerful Joomla template framework
 *
 * @version     1.4.3
 * @since       1.4.3
 * @link        http://www.zootemplate.com/zo2
 * @link        https://github.com/cleversoft/zo2
 * @author      ZooTemplate <http://zootemplate.com>
 * @copyright   Copyright (c) 2014 CleverSoft (http://cleversoft.co/)
 * @license     GPL v2
 */
defined('_JEXEC') or die('Restricted access');

/**
 * Class exists checking
 */
if (!class_exists('ZtonepageHtml'))
{

    /**
     * @since 1.4.3
     * Used to fetch template file
     */
    class ZtonepageHtml extends JObject
    {

        /**
         *
         * @var ZtPath 
         */
        private $_path;

        /**
         * Constructor
         * @param object|array $properties
         */
        public function __construct($properties = null)
        {
            parent::__construct($properties);
            /* Init local variables */
            $this->_path = ZtonepagePath::getInstance();
        }

        /**
         * 
         * @return string
         */
        public static function _()
        {
            $args = func_get_args();
            $prefix = array_shift($args);
            $method = array_shift($args);
            $className = 'ZtonpageHtml' . ucfirst($prefix);
            $class = new $className();
            return call_user_func_array(array($class, (string) $method), $args);
        }

        public static function field()
        {
            $args = func_get_args();
            $type = array_shift($args);
            $label = array_shift($args);
            $data = array_shift($args);
            if (!isset($data['value']))
            {
                $data['value'] = isset($data['default']) ? $data['default'] : '';
            }
            $html = new ZtonepageHtml();
            $html->set('label', $label);
            $html->set('data', $data);
            return $html->fetch('fields/' . $type . '.php');
        }

        /**
         * Fetch template file
         * @param string $key
         * @return string
         */
        public function fetch($key)
        {
            $tplFile = $this->_path->getPath($key);
            /* Make sure this template file is exists */
            if ($tplFile)
            {
                $properties = $this->getProperties();
                ob_start();
                extract($properties, EXTR_REFS);
                include($tplFile);
                $content = ob_get_contents();
                ob_end_clean();
                return $content;
            }
        }

        /**
         * Include another template into current template
         * @return \ZtHtml
         */
        public function load($key)
        {
            $tplFile = $this->_path->getPath($key);
            if ($tplFile)
            {
                $properties = $this->getProperties();
                extract($properties, EXTR_REFS);
                include($tplFile);
            }
            return $this;
        }

    }

}