<?php

namespace Modules\ActirovkiWidget\Console;

use Illuminate\Console\Command as BaseCommand;
use Illuminate\Support\Facades\Context;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Command extends BaseCommand
{
    public function run(InputInterface $input, OutputInterface $output): int
    {
        Context::add('module', 'ActirovkiWidget');

        return parent::run($input, $output);
    }
}
