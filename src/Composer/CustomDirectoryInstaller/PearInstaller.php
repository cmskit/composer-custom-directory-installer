<?php

namespace Composer\CustomDirectoryInstaller;

use Composer\Package\PackageInterface;
use Composer\Installer\PearInstaller as BasePearInstaller;

class PearInstaller extends BasePearInstaller
{
  public function getInstallPath(PackageInterface $package)
  {
    if ($this->composer->getPackage()) 
    {
      // prefix => path
      $prefixes = array(
        'core' => 'backend/',
        'admin' => 'backend/admin/NAME/',
        'extension' => 'backend/extensions/NAME/',
        'template' => 'backend/templates/NAME/',
        'wizard' => 'backend/wizards/NAME/',
      )
      
      $packageName = $this->composer->getPackage()->getName();
      
      $parts = explode('/', $packageName);// 1. split vendor/PACKAGE-NAME
      $parts = explode('-', $parts[1]);// 2. split PREFIX-package-name
      $prefix = array_shift($parts);// 3. extract the prefix (we don't need it anymore)
      
      if (isset($prefixes[$prefix]))
      {
		  $folderName = implode('_', $parts);
		  return str_replace('NAME', $folderName, $prefixes[$part[0]]);
	  }
    }

    /**
     * In case, the package-name dosen't match any rule
     * use the default one, by calling the parent::getInstallPath function
     */
    return parent::getInstallPath($package);
  }
}
