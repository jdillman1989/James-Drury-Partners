# Onyx Setup

Onyx is a hackable WordPress theme. The [Slate framework](https://github.com/bmc75/slate) is required for Onyx to work. This theme is the bare minimum requirements to get started building a WordPress website. The idea is that no two designs are the same and for things like post pages it can take as much time to modify a premade solution than to just create it or import it from a pattern library.

## Installation

To install Onyx simply create a new folder in your `wp-content/themes` folder called "onyx" and clone this repository. Activate the theme and you are ready to begin development.

## Assets

Onyx utilizes [Slate's asset loading API](https://github.com/bmc75/slate#asset-loading). You can find it in use at `classes/onyx-assets.php`.

### Preloaded Styles & Scripts

Onyx comes preloaded with the following CSS or JavaScript frameworks or plugins:

* [Bootstrap](http://getbootstrap.com/) (Grid & Responsive Utilities Only)
* [Font Awesome 4.2](http://fortawesome.github.io/Font-Awesome/)
* [Swipebox](http://brutaldesign.github.io/swipebox/)
* [Cycle 2](http://jquery.malsup.com/cycle2/)
* [HTML 5 Shiv](https://github.com/aFarkas/html5shiv)
* [Respond.js](https://github.com/scottjehl/Respond)

## Class Autoloading

Thanks to Slate classes are autoloaded within this theme. To be autoloaded the class must be prefixed with `Onyx_` and the file must be located in the `classes` folder. The filename must be preceded with `onyx-`. So if for example you want to load a class with search functionality, you could create a file called `onyx-search.php` in the classes folder, and declare the class name as such: `class Onyx_Search`.

## Page Setup

You will notice that every template file (404.php, archive.php, index.php, etc.) is setup differently from common WordPress themes. The goal is that if you open a tag in a file (example: the `<html>`) then it should be closed in the same file. The same goes for if the site needs a "wrapper container div". The act of opening tags and closing them in different files can get very confusing, so Onyx works to reduce that and create a cleaner code environment.

### wp_head()

The `wp_head` hook is used to output everything that goes in the `<head>` tag. You can find the class that controls the output in `classes/onyx-head.php`.

### header.php & footer.php

`header.php` and `footer.php` are for displaying their respective elements. It's common in WordPress themes to have a lot of logic and PHP here, especially in `header.php`, but this should be avoided where possible.