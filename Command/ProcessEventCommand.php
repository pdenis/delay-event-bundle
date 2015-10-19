<?php

namespace Itkg\DelayEventBundle\Command;

use Itkg\DelayEventBundle\DomainManager\EventManager;
use Itkg\DelayEventBundle\Model\Event;
use Itkg\DelayEventBundle\Processor\EventProcessor;
use Itkg\DelayEventBundle\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ProcessEventCommand
 */
class ProcessEventCommand extends ContainerAwareCommand
{
    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * @var EventProcessor
     */
    private $eventProcessor;

    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * @param EventManager    $eventManager
     * @param EventRepository $eventRepository
     * @param EventProcessor  $eventProcessor
     * @param null|string     $name
     */
    public function __construct(EventManager $eventManager, EventRepository $eventRepository, EventProcessor $eventProcessor, $name = null)
    {
        $this->eventRepository = $eventRepository;
        $this->eventProcessor = $eventProcessor;
        $this->eventManager = $eventManager;

        parent::__construct($name);
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('itkg_delay_event:process')
            ->setDescription('Process async events')
            ->addArgument('n', InputArgument::OPTIONAL, 'Number of events to process', 1);
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $events = $this->eventRepository->findBy(array(), array('createdAt' => 1), $input->getArgument('n'));

        /** @var Event $event */
        foreach ($events as $event) {
            try {
                /** @TODO : ADD LOGS */
                $event->setDelayed(false);

                $this->eventProcessor->process($event);
                $this->eventManager->delete($event);
            } catch(\Exception $e) {
                // @TODO : Manage rollback count maybe
                $event->rollback();
                die($e->getMessage());
                $this->eventManager->save($event);
            }
        }
    }
}
