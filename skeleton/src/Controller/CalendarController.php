<?php 

namespace App\Controller; 
use App\Repository\UserRepository; 
use App\Repository\PeriodRepository; 
use App\Repository\BookletRepository; 
use App\Repository\BookletPeriodRepository; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Attribute\Route; 
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 

final class CalendarController extends AbstractController 
{ 
    #[Route('/events', name: 'app_events')] public function events(BookletPeriodRepository $bookletPeriodRepository, BookletRepository $bookletRepository, PeriodRepository $periodRepository, UserRepository $userRepository): JsonResponse 
    { // trouver l'utilisateur 
    $user = $this->getUser();
    // trouver le livret de suivi qui correspond à l'utilisateur 
    $booklet = $bookletRepository->findByStudent($user); 
    // trouver toutes les périodes qui appartiennent au livret de suivi via BookletPeriods 
    
    if ($booklet) 
    { 
        $bookletPeriods = $booklet->getBookletPeriods(); 
        // pour chaque période trouvée, retrouver le nom, la date de début et la date de fin via Period 
        $events = []; foreach ($bookletPeriods as $bookletPeriod) 
        { 
            $events[] = [$bookletPeriod->getPeriod()->getId()]; 
            $associatedPeriod = $periodRepository->find($bookletPeriod->getPeriod()->getId()); 
            $typeName = $associatedPeriod->getType()->getName(); 
            $color = ''; 
            if ($typeName == 'Stage') 
                { 
                    $color = '#93a2ce'; 
                } 
            else if ($typeName == 'Formation') 
            { 
                $color = '#afd2a3'; 
            } 
            else 
            { 
                $color = 'red'; 
            } 
            
            $events[] = [ 
                'id' => $bookletPeriod->getId(), 
                'title' => $associatedPeriod->getName(). " - " .$associatedPeriod->getType()->getName(), 
                'start' => in_array($typeName, ['Vacances', 'Pont/Jour férié']) ? $associatedPeriod->getStartDate()->format('Y-m-d 00:00:00') : $associatedPeriod->getStartDate()->format('Y-m-d H:i:s'), 
                'end' => in_array($typeName, ['Vacances', 'Pont/Jour férié']) ? $associatedPeriod->getEndDate()->format('Y-m-d 23:59:59') : $associatedPeriod->getEndDate()->format('Y-m-d H:i:s'), 
                'backgroundColor' => $color, 'rendering' => in_array($typeName, ['Vacances', 'Pont/Jour férié']) ? 'background' : 'auto', ]; 
            } 
        } 
        
        return new JsonResponse($events); 
    } 
}