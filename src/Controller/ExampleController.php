<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\JobSector;
use App\Repository\JobRepository;
use App\Service\DevLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/example")
 */
class ExampleController extends AbstractController
{

    /**
     * @Route("/", name="job_offers", methods={"GET"})
     */
    public function exampleRoute(JobRepository $jobRepository): Response
    {
        $jobs = [new Job()];
        $jobSectors = [new JobSector()];

        $devlog = new DevLog();
        $devlog->log('$jobs', $jobs);
        
        $jobs = new Job();
        $devlog->log('$jobs pas dans un tableau', $jobs);
        
        
        $jobs = [new Job(), new Job(), new Job(), new Job()];
        $devlog->log('$jobs plusieurs dans un tableau', $jobs);
        $devlog->log('$jobSectors', $jobSectors);

        return $this->render('job/job_offers.html.twig', [
            'jobs' => $jobs,
            'job_sectors' => $jobSectors
        ]);
    }
}
