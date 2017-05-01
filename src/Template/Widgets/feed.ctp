<?php

use Cake\Routing\Router;

?>
<?php if (empty($events)): ?>
    <p class="no_events">
        <?php if ($isAjax): ?>
            No more events found.
        <?php else: ?>
            No upcoming events found.
            <br />
            <?= $this->Html->link('Add an upcoming event', ['controller' => 'events', 'action' => 'add']); ?>
        <?php endif; ?>
    </p>
    <?php $this->Js->buffer("muncieEventsFeedWidget.setNoMoreEvents();"); ?>
<?php else: ?>
    <?php foreach ($events as $date => $daysEvents): ?>
        <?php
            if ($date == date('Y-m-d')) {
                $day = 'Today';
            } elseif ($date == date('Y-m-d', strtotime('tomorrow'))) {
                $day = 'Tomorrow';
            } else {
                $day = date('l', strtotime($date));
            }
        ?>
        <?php if (count($daysEvents) > 1): ?>
        <h2 class="short_date">
            <?= date('M j', strtotime($date)); ?>
        </h2>
        <h2 class="day">
            <?= $day; ?>
        </h2>
        <ul>
            <?php foreach ($daysEvents as $event): ?>
                <li <?php if (!empty($event['EventsImage'])): ?>class="with_images"<?php endif; ?>>
                    <?php if (!empty($event['EventsImage'])): ?>
                        <?php
                            $image = array_shift($event['EventsImage']);
                            echo $this->Calendar->thumbnail('tiny', [
                                'filename' => $image['Image']['filename'],
                                'caption' => $image['caption'],
                                'group' => 'event_minimized'.$event->id
                            ]);
                        ?>
                    <?php endif; ?>
                    <?php $url = Router::url(['controller' => 'events', 'action' => 'view', 'id' => $event->id]); ?>
                    <a href="<?= $url; ?>" title="Click for more info" class="event_link" id="event_link_<?= $event->id; ?>">
                        <?= $this->Icon->category($event->category->name); ?>
                        <div class="title">
                            <?= $event->title; ?>
                        </div>
                        <div class="when_where">
                            <?= date('g:ia', strtotime($event->time_start)); ?>
                            @
                            <?= $event->location ? $event->location : '&nbsp;'; ?>
                        </div>
                    </a>
                    <?php if (!empty($event['EventsImage'])): ?>
                        <div class="hidden_images">
                            <?php foreach ($event['EventsImage'] as $image): ?>
                                <?= $this->Calendar->thumbnail('tiny', [
                                    'filename' => $image['Image']['filename'],
                                    'caption' => $image['caption'],
                                    'group' => 'event_minimized'.$event['Event']['id']
                                ]); ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif (count($daysEvents) == 1): ?>
        <h2 class="short_date">
            <?= date('M j', strtotime($date)); ?>
        </h2>
        <h2 class="day">
            <?= $day; ?>
        </h2>
        <ul>
                <li <?php if (!empty($daysEvents['EventsImage'])): ?>class="with_images"<?php endif; ?>>
                    <?php if (!empty($daysEvents['EventsImage'])): ?>
                        <?php
                            $image = array_shift($daysEvents['EventsImage']);
                            echo $this->Calendar->thumbnail('tiny', [
                                'filename' => $image['Image']['filename'],
                                'caption' => $image['caption'],
                                'group' => 'event_minimized'.$daysEvents->id
                            ]);
                        ?>
                    <?php endif; ?>
                    <?php $url = Router::url(['controller' => 'events', 'action' => 'view', 'id' => $daysEvents->id]); ?>
                    <a href="<?= $url; ?>" title="Click for more info" class="event_link" id="event_link_<?= $daysEvents->id; ?>">
                        <?= $this->Icon->category($daysEvents->category->name); ?>
                        <div class="title">
                            <?= $daysEvents->title; ?>
                        </div>
                        <div class="when_where">
                            <?= date('g:ia', strtotime($daysEvents->time_start)); ?>
                            @
                            <?= $daysEvents->location ? $daysEvents->location : '&nbsp;'; ?>
                        </div>
                    </a>
                    <?php if (!empty($daysEvents['EventsImage'])): ?>
                        <div class="hidden_images">
                            <?php foreach ($daysEvents['EventsImage'] as $image): ?>
                                <?= $this->Calendar->thumbnail('tiny', [
                                    'filename' => $image['Image']['filename'],
                                    'caption' => $image['caption'],
                                    'group' => 'event_minimized'.$daysEvents['Event']['id']
                                ]); ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </li>
        </ul>
    <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
