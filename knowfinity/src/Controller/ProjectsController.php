<?php

namespace App\Controller;

use App\Service\GitHubService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    #[Route('/projects', name: 'app_projects')]
    public function index(GitHubService $gitHubService): Response
    {
        $username = 'muturipetr';  // Replace with your GitHub username
        $repos = $gitHubService->getRepositories($username); // Calls the API through the service
        $url = "https://api.github.com/users/$username/repos";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');

        $output = curl_exec($ch);
        curl_close($ch);

        $repositories = json_decode($output, true);

        if (isset($repositories['message']) && $repositories['message'] == 'Not Found') {
            throw new \Exception('GitHub user not found');
        }

        $repos = [];
        foreach ($repositories as $repo) {
            $repos[] = [
                'html_url' => $repo['html_url'],
                'name' => $repo['name'],
                'description' => $repo['description']
            ];
        }
        return $this->render('projects/index.html.twig', [
            'repositories' => $repos,
        ]);
    }
}
