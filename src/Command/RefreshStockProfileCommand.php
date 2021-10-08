<?php

namespace App\Command;

use App\Entity\Stock;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RefreshStockProfileCommand extends Command
{
    protected static $defaultName = 'app:refresh-stock-profile';
    protected static $defaultDescription = 'Add a short description for your command';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Retrieve a stock profile from the Yahoo Finance API. Update the record in the DB')
            ->addArgument('symbol', InputArgument::REQUIRED, 'Stock symbol e.g. AMZN for Amazon')
            ->addArgument('region', InputArgument::REQUIRED, 'The region of the company e.g. US for United States');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stock = new Stock();
        $stock->setSymbol('AMZN');
        $stock->setShortName('Amazon.com, Inc.');
        $stock->setCurrency('USD');
        $stock->setExchangeName('NasdaqGS');
        $stock->setRegion('US');
        $stock->setPrice(200);
        $stock->setPreviousClose(200);
        $stock->setPriceChange(0);

        $this->entityManager->persist($stock);
        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
