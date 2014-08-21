cms-kit-installer
===================================

This is a composer plugin, to install composer packages in custom directories outside the default composer vendor folder.

It relies on a special prefix within the package-name:

Prefixes are installed to following paths

        'admin' => './backend/admin/NAME/'
        'extension' => './backend/extensions/NAME/'
        'template' => './backend/templates/NAME/'
        'wizard' => './backend/wizards/NAME/'

The prefix will be removed and dashes were replaced by underscores.

Examples:

* your-vendor-name/admin-project-setup will be installed to backend/admin/project_setup
* your-vendor-name/extension-usermanagement will be installed to backend/extensions/usermanagement



## Example of package composer.json 

	{
	    "name": "cmskit/admin-project-setup",
	    "type": "library",
	    "version": "0.6.0",
	    "description": "This wizard lets you create new projects or upload existing ones",
	    "license": "GPL",
	    "authors": [
		{
		    "name": "Christoph Taubmann",
		    "email": "info@cms-kit.com"
		}
	    ],
	    "homepage": "http://cms-kit.com",
	    "require": {
		"php": ">=5.3.3",
		"cmskit/package-installer": "1.0.*@dev",
		"cmskit/jquery-ui": "dev-master"
	    }
	}

## Example of the composer.json in root to install/update the package

	{
	    "minimum-stability": "dev",

	    "require": {
		"php": ">=5.3.3",
		"cmskit/admin-project-setup": "dev-master"
	    }
	}

