<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class GameController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;
    private GameRepository $gameRepository;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, GameRepository $gameRepository)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        $this->gameRepository = $gameRepository;
    }

    /**
     */
    #[Route('/game/create', name: 'game_create')]
    public function createGame(Request $request): Response
    {
        $game = new Game();
        $game->setCreatedAt(new \DateTime());

        $player = new User();
        $form = $this->createForm(UserType::class, $player);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $player,
                $player->getPassword()
            );

            $player->setPassword($hashedPassword);
            $player->setRoles(['ROLE_USER']);
            $game->setPlayerOne($player);

            $this->entityManager->persist($game);
            $this->entityManager->persist($player);
            $this->entityManager->flush();

            return $this->redirectToRoute('game_room');
        }

        return $this->render('game/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/game/join', name: 'game_join')]
    public function joinGame(): Response
    {
        // Logique pour rejoindre une partie
        return $this->render('game/join.html.twig');
    }

    #[Route('/gameRoom', name: 'game_room')]
    public function gameRoom(): Response
    {
        $games = $this->gameRepository->findAll();

        return $this->render('game/room.html.twig', ['games' => $games]);
    }
}
