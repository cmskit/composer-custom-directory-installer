<?php

namespace Composer\CustomDirectoryInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller as BaseLibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;

class LibraryInstaller extends BaseLibraryInstaller
{
  public function getInstallPath(PackageInterface $package)
  {

    if ($this->composer->getPackage()) 
    {
      // prefix => path
      $prefixes = array(
        'core' => 'backend/',
        'adminwizard' => 'backend/admin/NAME/',
        'extension' => 'backend/extensions/NAME/',
        'template' => 'backend/templates/NAME/',
        'wizard' => 'backend/wizards/NAME/',
      )
      
      $packageName = $this->composer->getPackage()->getName();
      
      $parts = explode('/', $packageName);// split vendor/PACKAGE-NAME
      $part = explode('-', $parts[1]);// split PREFIX-package-name
      
      if (isset($prefixes[$part[0]]))
      {
		  return str_replace('NAME', $parts[1], $prefixes[$part[0]]);
	  }
    }

    /**
     * In case, the package-name dosen't match any rule
     * use the default one, by calling the parent::getInstallPath function
     */
    return parent::getInstallPath($package);
  }
}
