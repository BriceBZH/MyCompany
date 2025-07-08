<?php

namespace App\Twig;

use App\Repository\ModuleRepository;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class GlobalServices extends AbstractExtension implements GlobalsInterface
{
    public function __construct(private ModuleRepository $moduleRepository)
    {
    }

    public function getGlobals(): array
    {
        return [
            'enableModules' => $this->moduleRepository->findBy(['enabled' => true]),
        ];
    }
}
