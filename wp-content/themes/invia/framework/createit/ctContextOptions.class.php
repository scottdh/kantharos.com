<?php
if (!class_exists('ctContextOptions')) {
    /**
     * Class ctGetOptionHelper
     */
    define ('CUSTOMIZER_NAMESPACE', 'ct_option');

    class ctContextOptions
    {

        /**
         * @var
         */
        protected static $uniqueId;

        /**
         * @var string
         */


        protected $settings = array(
            'priority' => array('shortcode', 'meta', 'customizer', 'global'),
            'without_namespace' => array('shortcode', 'meta', 'global', 'customizer'),
            'context' => 'auto',
            'global_detection' => true,//per field
            'global_detection_id' => 'global',//per field
            'global_option_source' => 'customizer',
            'force_empty_value' => 'ct_none'
        );

        /**
         * @return string
         * todo: detect woocommerce shop index page
         */
        public function getContext()
        {
            //is blog?
            if (get_option('page_for_posts') == get_queried_object_id() && !is_single()) {
                return 'posts_index_';
            }
            //is page?
            if (is_page()) {

                return 'pages_';
            }

            //is 404?
            if (is_404()) {
                return 'pages_';
            }

            //is single blog?
            if (is_single() && get_post_type() == 'post') {
                return 'posts_single_';
            }

            //is single?
            if (is_single()) {
                return get_post_type() . '_single_';
            }

            // portfolio etc
            if (is_post_type_archive()) {
                $queriedObject = get_queried_object();
                if (isset($queriedObject->rewrite)) {
                    $tmp = $queriedObject->rewrite;
                    if (isset($tmp['slug'])) {
                        //var_dump($tmp['slug'] . '_index_');
                        return $tmp['slug'] . '_index_';
                    }
                }
            }

            //Unrecognized.
            return  apply_filters('ct_context_options.custom_context','');//Another context?
        }


        /**
         * @param $key
         *
         * @return string
         */
        protected function getShortcodeValue($key, $shortcodeAtts = array())
        {
            if (!is_array($shortcodeAtts) || !array_key_exists($key, $shortcodeAtts)) {
                return self::$uniqueId;
            }
            $value = $shortcodeAtts[$key];

            return $value;
        }

        /**
         * @param $key
         *
         * @return string
         */
        protected function getMetaValue($key)
        {
            if (is_post_type_archive()) {
                return self::$uniqueId;
            }


            //w META dla opcji indeksu bloga , używaj ID indeksu bloga
            if (self::getContext() == 'posts_index_') {
                $id = get_option('page_for_posts');
            } else {
                $id = get_the_id();
            }

            /*
            if ($key =='posts_index_header_show_title_box'){
                var_dump(self::getContext());exit();
            }
            */

            $custom = get_post_custom($id);
            return isset($custom[$key][0]) ? $custom[$key][0] : self::$uniqueId;
        }

        /**
         * @param $key
         *
         * @return string
         */
        protected function getGlobalValue($key)
        {
            if (!ct_has_option($key)) {
                return self::$uniqueId;
            }
            $value = ct_get_option($key, '');
            return $value;
        }

        /**
         * @param $key
         *
         * @return string
         */
        protected function getCustomizerValue($key)
        {

            $name = CUSTOMIZER_NAMESPACE . '_' . $key;
            $mods = get_theme_mods();
            //var_dump($mods);exit();
            if (isset($mods[$name])) {
                /* if ($name ==CUSTOMIZER_NAMESPACE . '_posts_index_header_title_box_padding_top'){
                     var_dump($mods[$name]);exit();
                 }*/
                return apply_filters("theme_mod_{$name}", $mods[$name]);
            } else {
                //$uniqueId zwracaj jeżeli opcja nie istnieje!
                //var_dump($key);
                return self::$uniqueId;
            }

        }


        /**
         * @param $option_id
         * @param $shortcodeAtts
         * @param array $args
         * @param string $default
         *
         * @return mixed|string
         */
        public function ctGetOption($option_id, $default = '', $shortcodeAtts = array(), $args = array())
        {
            self::$uniqueId = uniqid();

            //filtruj default settings
            $this->settings =  apply_filters('ct_context_options.default_settings', $this->settings);

            if (is_array($args)) {
                $args = array_merge($this->settings, $args);
                $this->settings = $args;
            }

            if (!isset($option_id) || !is_string($option_id)) {
                return '';
            }

            //set namespace (context)
            if ($args['context'] == 'auto' || $args['context'] == true) {
                $currentContext = $this->getContext();
                $namespace = $currentContext;
            } else {
                $namespace = strval($args['context'] . '_');
                $currentContext = '';
            }

            $globalId = $args['global_detection_id'];
            $globalSource = $args['global_option_source'];

            $value = '';
            //loop in priority array (data sources)
            foreach ($args['priority'] as $key) {
                $method = 'get' . ucfirst($key) . 'Value';//prepare method name by options type

                //if option method exist try to get option
                if (method_exists($this, $method)) {

                    //create namespace if necessary
                    if (is_array(($args['without_namespace'])) && in_array($key, $args['without_namespace'])) {

                        $value = call_user_func(array(
                            $this,
                            'get' . ucfirst($key) . 'Value'
                        ), $option_id, $shortcodeAtts);
                    } else {

                        //! korzystaj z namespace "pages" dla opcji w meta na indeksie bloga!
                        $namespaceCache = $namespace;
                        if ($currentContext == 'posts_index_' && $key == 'meta') {
                            $namespace = 'pages_';
                        }

                        /*debug
                        if ($option_id =='header_type'){
                             var_dump($namespace . $option_id);
                             exit();
                         }*/

                        $value = call_user_func(array(
                            $this,
                            'get' . ucfirst($key) . 'Value'
                        ), $namespace . $option_id, $shortcodeAtts);
                        $namespace = $namespaceCache;
                    }


                    /*
                     * $value jest dostępne.
                     * Sprawdź czy value przekierowuje do opcji gloablnych
                     */
                    if (($args['global_detection'] && $value == $args['global_detection_id'])

                    ) {
                        /*
                         * Wykryte rządanie pobrania opcji globalnej
                         * Pobierz opcje z namespace lub bez
                         */
                        if (is_array(($args['without_namespace'])) && in_array($globalId, $args['without_namespace'])) {
                            $value = call_user_func(array(
                                $this,
                                'get' . ucfirst($globalSource) . 'Value'
                            ), $option_id, $shortcodeAtts);
                        } else {
                            $value = call_user_func(array(
                                $this,
                                'get' . ucfirst($globalSource) . 'Value'
                            ), $namespace . $option_id, $shortcodeAtts);
                        }

                        /*
                         * $value === $args['force_empty_value'] - wartość ma być pustym stringiem, nie sprawdzaj dalej tylko zwróć pustego stringa
                         */
                        if ($value === $args['force_empty_value']) {
                            $value = '';
                            return $value;
                        }
                        /*
                         * $value != self::$uniqueId && $value != ''
                         * Zwróć value jeżeli opcja istnieje (!&uniqueId) oraz nie jest pusta
                         *
                         */
                        if ($value != self::$uniqueId && $value != '') {
                            return $value;
                        }

                        /*
                         * Globalne ustawnienie nie istnieje albo jest puste,
                         * zwróć default
                         */
                        return $default;
                        /*
                         * else - nie wykryto global force
                         */
                    } else {
                        /*
                        * $value === $args['force_empty_value'] - wartość ma być pustym stringiem, nie sprawdzaj dalej tylko zwróć pustego stringa
                        */
                        if ($value === $args['force_empty_value']) {
                            $value = '';
                            return $value;
                        }
                        /*
                         * $value != self::$uniqueId && $value != ''
                         * Zwróć value jeżeli opcja istnieje (!&uniqueId) oraz nie jest pusta
                         * W przeciwnym wypadku nowy obrót pętli (opcja z kolejnego źródła)
                         */
                        if ($value != self::$uniqueId && $value != '') {
                            return $value;
                        }
                    }

                }
                continue;
            }

            /*
            * $value === $args['force_empty_value'] - wartość ma być pustym stringiem, nie sprawdzaj dalej tylko zwróć pustego stringa
            */
            // uniqueID = option does not exist
            if ($value == self::$uniqueId) {
                return $default;
            }

            return $value;
        }
    }
}
/**
 * Get option from context
 *
 * @param $field
 * @param string $default
 * @param array $atts
 * @param array $args
 */
if (!function_exists('ct_get_context_option')) {
    function ct_get_context_option($field, $default = '', $atts = array(), $args = array())
    {
        //@todo nowa klasa etc.
        $obj = new ctContextOptions();

        return $obj->ctGetOption($field, $default, $atts, $args);
    }
}


if (!function_exists('ct_get_current_page_setting')) {
    function ct_get_current_page_setting($field, $default = '', $atts = array(), $args = array('without_namespace' => array(), 'context' => true))
    {
        $obj = new ctContextOptions();
        return $obj->ctGetOption($field, $default, $atts, $args);
    }
}
