<?php
/**
 * Slate autoloader
 *
 * The Slate autoloader detects when a class needs to be instantiated. It then loads the appropriate
 * file and instantiates the class.
 *
 * @since 1.0
 *
 * @package WordPress
 * @subpackage Slate
 */

class Slate_Autoloader {

    /**
     * Loads the file and class
     *
     * The loader class first checks if a file exists and then includes it. After, it will
     * check if the requested class exists and return true if it does.
     *
     * @since 1.0
     *
     * @param string $class_name The name of the class to load. Example: "Slate_ACF" looks for the "slate-acf.php" file and loads the "Slate_ACF" class.
     * @return bool
     */

    static public function loader($class_name) {

        // Make sure that the autoloader is only loading classes that belong to Slate.
        if(strstr($class_name, "Slate_")) {

            $filename = slate_classes . '/' . strtolower(str_replace('_', '-', $class_name)) . '.php';
            $filename_alt = slate_custom . '/' . strtolower(str_replace('_', '-', $class_name)) . '.php';

            if(file_exists($filename)) {

                include_once $filename;

                if(class_exists($class_name)) {
                    return true;
                }

            }

            if(file_exists($filename_alt)) {

                include_once $filename_alt;

                if(class_exists($class_name)) {
                    return true;
                }

            }

        }

        // Slate can also autoload classes for the Onyx companion theme.
        if(strstr($class_name, 'Onyx_')) {

            $filename = theme_classes . '/' . strtolower(str_replace('_', '-', $class_name)) . '.php';

            if(file_exists($filename)) {

                include_once $filename;

                if(class_exists($class_name)) {
                    return true;
                }

            }

        }

		// Let's get awesome.
        if(strstr($class_name, '_Service')) {

            $filename = _template_dir . '/services/' . strtolower(str_replace('_', '-', $class_name)) . '.php';

            if(file_exists($filename)) {

                include_once $filename;

                if(class_exists($class_name)) {
                    return true;
                }

            }

        }

		if($class_name == "_Container") {
			$filename = _template_dir . '/services/_container.php';

            if(file_exists($filename)) {

                include_once $filename;

                if(class_exists($class_name)) {
                    return true;
                }

            }
		}

        return false;

    }

}

spl_autoload_register('Slate_Autoloader::loader');
