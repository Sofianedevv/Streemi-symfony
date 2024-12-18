<?php

namespace App\Controller\Media\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MediaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Movie;

class MovieController extends AbstractController
{#[Route(path: '/movie/{id}', name: 'page_detail_movie')]
    public function detailMovie(MediaRepository $mediaRepository, int $id): Response
    {
        $movie = $mediaRepository->find($id);
    
        if (!$movie) {
            throw $this->createNotFoundException('Movie not found with ID ' . $id);
        }
    
        if (!$movie instanceof Movie) {
            throw $this->createNotFoundException('The media with ID ' . $id . ' is not a Movie.');
        }
    
        return $this->render('media/movie/detail.html.twig', [
            'movie' => $movie,
        ]);
    }
    


    #[Route(path: '/movies', name: 'page_movies')]
    public function showAllSerie(MediaRepository $mediaRepository): Response
    {
        $movies = $mediaRepository->findAllMovies();

        return $this->render('media/display_media.html.twig', [
            'movies' => $movies
        ]);
    }

}