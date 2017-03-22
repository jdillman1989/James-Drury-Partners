# Slate

Slate is a framework geared towards simplifying common WordPress development tasks such as loading CSS or JavaScript and creating post types or taxonomies. It also features integration with the [Advanced Custom Fields](http://advancedcustomfields.com/) plugin.

## Slate Constants

The `slate-constants.php` file contains several predefined PHP constants for use in themes and plugins. Some of the directory and URL dependant constants may need to be altered depending on theme structure.

## Asset Loading

To utilize Slate's asset loading simply instantiate the `Slate_CSS`, `Slate_Jquery` or `Slate_JS` classes within the [wp_enqueue_scripts](http://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts) hook. Example:

```
add_action('wp_enqueue_scripts', 'slate_load_assets');
function slate_load_assets() {

    new Slate_CSS('style.css');
    new Slate_CSS('buttons.css');

    new Slate_Jquery;
    new Slate_JS('script.js');
    new Slate_JS('slider.js');

}
```

### CSS

By default Slate will load a CSS file by looking in the directory specified in the URL of the constant `_css_uri` in the `slate-constants.php` file. For example if there is a file called `stylesheet.css` located there, you can load it by calling Slate_CSS:

```
new Slate_CSS('stylesheet.css');
```

If the `_css_uri` is for example `http://url-to-my-theme.com/css` then it will try loading this file: `http://url-to-my-theme.com/css/stylesheet.css`.

You also have full access to the parameters of [wp_enqueue_style](http://codex.wordpress.org/Function_Reference/wp_enqueue_style):

```
new Slate_CSS('stylesheet.css', array(
    'handle' => 'main-stylesheet',
    'src'    => 'http://source-url.com/style.css',
    'ver'    => '2.0'
));
```

Using a third parameter you can tell Slate to try loading the file from the vendor directory URL as specified by the `_vendor_uri` constant in `slate-constants.php`:

```
new Slate_CSS('stylesheet.css', array(
    'handle' => 'main-stylesheet',
    'src'    => 'http://source-url.com/style.css',
    'ver'    => '2.0'
), true);
```

By setting the third parameter to true Slate will now set the base URL to the vendor directory.

### jQuery

Slate includes a special class for removing the default WordPress jQuery and loading it from the [Google CDN](https://developers.google.com/speed/libraries/devguide). Simply add the following:

```
new Slate_Jquery;
```

### JavaScript

By default Slate will load a JavaScript file by looking in the directory specified in the URL of the constant `_js_uri` in the `slate-constants.php` file. For example if there is a file called `script.js` located there, you can load it by calling Slate_JS:

```
new Slate_JS('script.js');
```

If the `_js_uri` is for example `http://url-to-my-theme.com/js` then it will try loading this file: `http://url-to-my-theme.com/js/script.js`.

You also have full access to the parameters of [wp_enqueue_script](http://codex.wordpress.org/Function_Reference/wp_enqueue_script):

```
new Slate_JS('script.js', array(
    'handle' => 'main-script',
    'src'    => 'http://source-url.com/script.js',
    'ver'    => '4.0'
));
```

Note: By default WordPress sets the in_footer parameter to false. Slate automatically sets it to true unless you override it with the arguments parameter.

Using a third parameter you can tell Slate to try loading the file from the vendor directory URL as specified by the `_vendor_uri` constant in `slate-constants.php`:

```
new Slate_JS('script.js', array(
    'handle' => 'main-script',
    'src'    => 'http://source-url.com/script.js',
    'ver'    => '4.0'
), true);
```

By setting the third parameter to true Slate will now set the base URL to the vendor directory.

## Creating a Post Type

```
new Slate_Post_Type($name, $args);
```

Post types can be created by opening the `slate-custom-post-types.php` file under the "slate-custom" directory.

Within the `slate_post_type_init` method simply create a new instance of `Slate_Post_Type`. Example:

```
new Slate_Post_Type('Books');
```

The above code will create a new post type with the label "Books" and the slug as "books".

All arguments available to the [register_post_type](http://codex.wordpress.org/Function_Reference/register_post_type) function are available to the class as a second optional parameter:

```
new Slate_Post_Type('Books', array(
    'supports' => array('title'),
    'labels'   => array(
        'name'          => 'Books',
        'singular_name' => 'Book'
    )
));
```

The above code would create a post type where the edit post page only displays the title field, and the singular name is "Book".

### Post Type Defaults

A few defaults are set by the Slate_Post_Type class which are different from the WordPress defaults:

* "public" is automatically set to true.
* "supports" is set to support by default title, editor, and thumbnail.

## Creating a Taxonomy

```
new Slate_Taxonomy($name, $post_type, $args);
```

Taxonomies can be created by opening the `slate-custom-taxonomies.php` file under the "slate-custom" directory.

Within the `slate_taxonomy_init` method simply create a new instance of `Slate_Taxonomy`. Example:

```
new Slate_Taxonomy('Book Type', 'books');
```

The above code would create a taxonomy called Book Type for the "books" post type.

All arguments available to the [register_taxonomy](http://codex.wordpress.org/Function_Reference/register_taxonomy) function are available to the class as a third optional parameter:

```
new Slate_Taxonomy('Book Type', 'books', array(
    'hierarchical' => false
));
```

The above code would create a taxonomy where the terms act as tags instead of categories.

### Taxonomy Defaults

A few defaults are set by the Slate_Taxonomy class which are different from the WordPress defaults:

* The `hierarchical` argument is automatically set to true since most times a taxonomy is preferred to act as a category.

## Advanced Custom Fields Integration

Slate integrates with the Advanced Custom Fields plugin, although having ACF enabled is not a requirement to use Slate. Version 5 of ACF allows for local storage of JSON field data to sync custom fields between different environments (local, staging, production, etc.) Slate changes the save and load points so the field data is automatically stored in the Slate plugin directory instead of the theme. This way if they change the theme the field JSON data isn't made irrelevant.

## Extra Functionality

Slate provides extra functionality and configuration through the `slate-functions.php` file.

### Theme Support

Slate enables theme support for post thumbnails and theme titles out of the box.

### Slate Debug

Slate will output debug information to your system console using the `_log()` function, which is just a wrapper for `error_log`:

```
_log(array('a' => 'b', 'c' => 'd'));
```