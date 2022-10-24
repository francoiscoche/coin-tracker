<?php

namespace App\Controller;

use App\Entity\Currency;
use App\Service\CallApiCoinsService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $allCurrency = $doctrine->getRepository(Currency::class)->findAll();

        return $this->render('home/index.html.twig', [
            'allCurrency' => $allCurrency,
        ]);
    }


    // Allow the data refresh when click update button on the dashboard
    #[Route('/update', name: 'app_update')]
    public function update(CallApiCoinsService $callApiCoinsService, ManagerRegistry $doctrine): Response
    {
        $coinsMarkets = $callApiCoinsService->getCoinsMarkets();
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository(Currency::class);

        foreach ($coinsMarkets as $coin) {

            $date = new \DateTime('@'.strtotime($coin["last_updated"]));
            // $currency = new Currency();
            $currency = $repository->findOneBy(['symbol' => $coin["symbol"]]);

            if ($currency) {
                $currency->setIdCoin($coin["id"]);
                $currency->setSymbol($coin["symbol"]);
                $currency->setName($coin["name"]);
                $currency->setImage($coin["image"]);
                $currency->setCurrentPrice($coin["current_price"]);
                $currency->setMarketCap($coin["market_cap"]);
                $currency->setMarketCapRank($coin["market_cap_rank"]);
                $currency->setTotalVolume($coin["total_volume"]);
                $currency->setAth($coin["ath"]);
                $currency->setLastUpdated($date);

                $entityManager->persist($currency);
                $entityManager->flush();
            }
        }
        $allCurrency = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'allCurrency' => $allCurrency,
        ]);
    }

    // Allow to open coin details when click on dashboard
    #[Route('/coins/{coinId}', name: 'app_details')]
    public function getDetails(ManagerRegistry $doctrine, $coinId = null) {
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository(Currency::class);
        $currency = $repository->findOneBy(['idCoin' => $coinId]);

        return $this->render('home/details.html.twig', [
            'currency' => $currency,
        ]);
    }
}