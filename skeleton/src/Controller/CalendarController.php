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
use DateTimeImmutable;

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
                'type' => $associatedPeriod->getType()->getName(),
                'title' => $associatedPeriod->getName(). " - " .$associatedPeriod->getType()->getName(), 
                'start' => in_array($typeName, ['Vacances', 'Pont/Jour férié']) ? $associatedPeriod->getStartDate()->setTime(0,0,0)->format('Y-m-d H:i:s') : $associatedPeriod->getStartDate()->format('Y-m-d H:i:s'), 
                'end' => in_array($typeName, ['Vacances', 'Pont/Jour férié']) ? $associatedPeriod->getEndDate()->setTime(23,59,59)->format('Y-m-d H:i:s') : $associatedPeriod->getEndDate()->format('Y-m-d H:i:s'), 
                'backgroundColor' => $color, 
                'rendering' => in_array($typeName, ['Vacances', 'Pont/Jour férié']) ? 'background' : 'auto', ]; 
            } 
        } 

        // Si un jour férié ou un pont chevauche une période de formation :
        // Couper la période de formation en 2 : avant et après le jour férié
        // Les deux events résultant auront un paramètre extendedProps: {bookletPeriodId: xxx} identique
    
        foreach($events as $event)
        {
            for($i = 0, $n = count($events) ; $i < $n ; $i++)
            {
                if ($event === $events[$i])
                {
                    continue;
                }
                $eventStart = new \DateTimeImmutable($events[$i]['start']);
                $eventEnd   = new \DateTimeImmutable($events[$i]['end']);
                $holidayStart = new \DateTimeImmutable($event['start']);
                $holidayEnd   = new \DateTimeImmutable($event['end']);
                $dayOfWeek = (int) $holidayStart->format('N');

                if ($event['type'] === 'Pont/Jour férié' && $holidayStart->format('Y-m-d H:i:s') >= $eventStart->setTime(00,00,00)->format('Y-m-d H:i:s') && $holidayEnd->format('Y-m-d H:i:s') <= $eventEnd->setTime(23,59,59)->format('Y-m-d H:i:s'))
                {
                    $replaceArr = [];
                    if($dayOfWeek === 1) 
                    {
                        $y = [ 
                            'bookletPeriodId' => $events[$i]['id'], 
                            'type' => $events[$i]['type'],
                            'title' => $events[$i]['title'], 
                            'start' => $holidayEnd->modify('+1 day')->setTime(0,0,0)->format('Y-m-d H:i:s'),
                            'end' => $eventEnd->format('Y-m-d H:i:s'), 
                            'backgroundColor' => $events[$i]['backgroundColor'], 
                            'rendering' => $events[$i]['rendering'], 
                        ];
                        $replaceArr = [$y];
                    } elseif ($dayOfWeek === 0)
                    {
                        $x = [ 
                            'bookletPeriodId' => $events[$i]['id'], 
                            'type' => $events[$i]['type'],
                            'title' => $events[$i]['title'], 
                            'start' => $eventStart->format('Y-m-d H:i:s'),
                            'end' => $holidayStart->modify('-1 day')->setTime(23,59,59)->format('Y-m-d H:i:s'), 
                            'backgroundColor' => $events[$i]['backgroundColor'], 
                            'rendering' => $events[$i]['rendering'] 
                        ];
                        $replaceArr = [$x];
                    } else {
                        $x = [ 
                            'bookletPeriodId' => $events[$i]['id'], 
                            'type' => $events[$i]['type'],
                            'title' => $events[$i]['title'], 
                            'start' => $eventStart->format('Y-m-d H:i:s'),
                            'end' => $holidayStart->modify('-1 day')->setTime(23,59,59)->format('Y-m-d H:i:s'), 
                            'backgroundColor' => $events[$i]['backgroundColor'], 
                            'rendering' => $events[$i]['rendering'] 
                        ];
                        $y = [ 
                            'bookletPeriodId' => $events[$i]['id'], 
                            'type' => $events[$i]['type'],
                            'title' => $events[$i]['title'], 
                            'start' => $holidayEnd->modify('+1 day')->setTime(0,0,0)->format('Y-m-d H:i:s'),
                            'end' => $eventEnd->format('Y-m-d H:i:s'), 
                            'backgroundColor' => $events[$i]['backgroundColor'], 
                            'rendering' => $events[$i]['rendering'], 
                        ];
                        $replaceArr = [$x, $y];
                    }
                    array_splice($events, $i, 1, $replaceArr);
                }
            }
        }

        return new JsonResponse($events); 
    } 
}