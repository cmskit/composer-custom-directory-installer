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
        'core' => './backend/',
        'admin' => './backend/admin/NAME/',
        'extension' => './backend/extensions/NAME/',
        'template' => './backend/templates/NAME/',
        'wizard' => './backend/wizards/NAME/',
      );
      
      $packageName = $this->composer->getPackage()->getName();
      
      $parts = explode('/', $packageName); // 1. split to get vendor/PREFIX-PACKAGE-NAME
      $parts = explode('-', $parts[1]); // 2. split to get PREFIX-package-name
      $prefix = array_shift($parts); // 3. extract the prefix (we don't need it anymore)
      
      if (isset($prefixes[$prefix]))
      {
          $folderName = implode('_', $parts);
          return str_replace('NAME', $folderName, $prefixes[$prefix]);
      }
    }

    /**
     * In case, the package-name dosen't match any "rule"
     * use the default one, by calling the parent::getInstallPath function
     */
    return parent::getInstallPath($package);
  }
}
