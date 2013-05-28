#App Template for CakePHP 2.2

This project should speed up the creating of a CakePHP Apps/Websites.

This template needs CakePHP 2.2.x now!  


##Including

## GruntJs Script

For watching and compiling Stylus and Coffeescript

### Controllers

*UsersController*

Just a small config-based UsersController. You can add, list and delete users. No Database needed!

### Plugins

#### Siteconfig

This plugin provides two function.

* "SiteSetting" - You can create custom settings and use them in your app.
* "DynRoute" - You can add custom routes to your app. The plugin will automaticlly create the right cakephp routes for you.

### Views

* Custom Flash Elements
* Custom Error Messages (400 & 500)

### Third-Party Libraries

* Jquery - http://jquery.com
* Modernizr - http://modernizr.com
* Html 5 Boilerplate mixed with Kube CSS
* CakeAjaxUploader CakePHP Plugin - https://github.com/traedamatic/CakeAjaxUploader

### Own Stuff
* SiteConfig Cakephp Plugin - controlls the routes and settings of the "CakeApp"
* UsersController (see above)

## How to use

### Setup

First create your new app-root folder:

```
mkdir mynewrootappdir
cd mynewrootappdir
```

after that clone this github-repo with this command (the "app" path is important.):

```
git clone git@github.com:traedamatic/CakePHP2.1-App-Template-.git app
```

Now, you can setup/start your Webserver and build your app...

Important!

You have to create your own index.php in the app/webroot dir. In most cases it will be enough to copy the original index.php from the cakephp "core" app.

### git submodules

In the app-folder you have to run this both commands:

```
git submodule init
git submodule update
```

After that you should go the Plugin/Csscrush - folder and run both commands again.

Now, all the submodules are ready to use.

### chmod (tmp, css)

CakePHP needs a tmp folder in the appdir. For me the best way is to copy the tmp-folder
from cakephp-app which comes with cakephp-core. Don't forget to "chmod -R 777" the whole folder

CssCrush needs wirte access to the webroot/css folder.

``` 
chmod 777 webroot/css
```

and the SiteConfig Plugin need write access for the configfiles:

``` 
chmod -R 777 Plugin/Siteconfig/Config/Site/*
```

## Future Work

* More Nice Css Styles
* Clean up the code!

Any Ideas?


## License & Copyright

Copyright 2012 - Nicolas Traeder - codebility.com
MIT LICENSE - (http://www.opensource.org/licenses/mit-license.php) 


