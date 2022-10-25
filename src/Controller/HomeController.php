<?php

namespace App\Controller;

use App\Entity\Bookmark;
use App\Entity\Currency;
use App\Service\CallApiCoinsService;
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

    /**
     * Allow the data refresh when click update button on the dashboard
     *
     * @param CallApiCoinsService $callApiCoinsService
     * @param ManagerRegistry $doctrine
     * @return Response
     */
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
                $currency->setIdCoin($coin["id"])
                        ->setSymbol($coin["symbol"])
                        ->setName($coin["name"])
                        ->setImage($coin["image"])
                        ->setCurrentPrice($coin["current_price"])
                        ->setMarketCap($coin["market_cap"])
                        ->setMarketCapRank($coin["market_cap_rank"])
                        ->setTotalVolume($coin["total_volume"])
                        ->setAth($coin["ath"])
                        ->setLastUpdated($date);

                $entityManager->persist($currency);
                $entityManager->flush();
            }
        }
        $allCurrency = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'allCurrency' => $allCurrency,
        ]);
    }

    /**
     * Allow to open coin details when click on dashboard
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    #[Route('/coins/{coinId}', name: 'app_details')]
    public function getDetails(ManagerRegistry $doctrine, $coinId = null) {
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository(Currency::class);
        $currency = $repository->findOneBy(['idCoin' => $coinId]);

        return $this->render('home/details.html.twig', [
            'currency' => $currency,
        ]);
    }


    /**
     * Allow user to favorite a currency
     *
     * @param Currency $currency
     * @param ManagerRegistry $doctrine
     * @return Response
     */
     #[Route('/coins/{id}/fav', name:"app_fav")]
    public function favorite(Currency $currency, ManagerRegistry $doctrine): Response {

        $entityManager = $doctrine->getManager();
        $bookmark= $entityManager->getRepository(Bookmark::class);

        $user = $this->getUser();

        // if there is no connected user, stop the process
        if(!$user) return $this->json([
            'message' => 'Unauthorized'
        ], 403);


        // if the currency is already favorite by the user, then it will unfavorite the currency
        if($currency->isFavoritesByUser($user)) {
            $fav = $bookmark->findOneBy([
                'idCurrency' => $currency,
                'user' => $user
            ]);

            $entityManager->remove($fav);
            $entityManager->flush();

            return $this->json([
                'message' => 'non favorite'
            ], 200);
        }

        // if the user is not favoring the currency then it will favorite the currency
        $fav = new Bookmark();
        $fav->setIdCurrency($currency)
            ->setUser($user);

        $entityManager->persist($fav);
        $entityManager->flush();

        return $this->json([
            'message' => 'added fav'
        ], 200);
    }
}