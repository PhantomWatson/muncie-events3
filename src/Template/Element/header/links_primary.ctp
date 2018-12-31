<?php
/**
 * @var \App\View\AppView $this
 */
?>
<ul class="navbar-nav">
    <li class="<?= (($this->request->getParam('controller') == 'Events') && ($this->request->getParam('action') == 'index')) ? 'active ' : '' ?>nav-item">
        <?= $this->Html->link('Home', ['plugin' => false, 'prefix' => false, 'controller' => 'Events', 'action' => 'index'], ['class' => 'nav-link']) ?>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="date_picker_toggler" data-toggle="collapse" href="#header_nav_datepicker" aria-controls="header_nav_datepicker">Go to Date...</a>
        <?php
            if (!isset($default)) {
                $default = date('m/d/Y');
            }
        ?>
        <div id="header_nav_datepicker" class="collapse" aria-labelledby="date_picker_toggler">
            <div>
                <?php
                $dayLinks = [];
                    foreach ($headerVars['populatedDates'] as $date) {
                        $calendarDate = $date[2] . '-' . $date[3] . '-' . $date[4];
                        if ($date[4] . '-' . $date[2] . '-' . $date[3] == date('Y-m-d')) {
                            $dayLinks[] = $this->Html->link('Today', [
                                'plugin' => false,
                                'prefix' => false,
                                'controller' => 'events',
                                'action' => 'today'
                            ]);
                            continue;
                        }
                        if ($date[4] . '-' . $date[2] . '-' . $date[3] == date('Y-m-d', strtotime('Tomorrow'))) {
                            $dayLinks[] = $this->Html->link('Tomorrow', [
                                'plugin' => false,
                                'prefix' => false,
                                'controller' => 'events',
                                'action' => 'tomorrow'
                            ]);
                            continue;
                        }
                        $dayLinks[] = $this->Html->link($date[0].', '.$date[1].' '.$date[3], [
                            'plugin' => false,
                            'prefix' => false,
                            'controller' => 'events',
                            'action' => 'day',
                            $date[2],
                            $date[3],
                            $date[4]
                        ]);
                        if (count($dayLinks) == 7) {
                            break;
                        }
                    }
                ?>
                <?php if (!empty($dayLinks)): ?>
                    <ul>
                        <?php foreach ($dayLinks as $dayLink): ?>
                            <li>
                                <?= $dayLink ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div id="header_datepicker"></div>
            </div>
        </div>
    </li>
    <li class="<?= (($this->request->getParam('controller') == 'Events') && ($this->request->getParam('action') == 'add')) ? 'active ' : '' ?>nav-item">
        <?= $this->Html->link('Add Event', ['plugin' => false, 'prefix' => false, 'controller' => 'Events', 'action' => 'add'], ['class' => 'nav-link']) ?>
    </li>
    <li class="<?= (($this->request->getParam('controller') == 'Widgets') && ($this->request->getParam('action') == 'index')) ? 'active ' : '' ?>nav-item">
        <?= $this->Html->link('Widgets', ['plugin' => false, 'prefix' => false, 'controller' => 'Widgets', 'action' => 'index'], ['class' => 'nav-link']) ?>
    </li>
</ul>
<?php
    #if (isset($headerVars['populatedDates'])) {
        #    foreach ($headerVars['populatedDates'] as $month => $days) {
    #        $quotedDays = array();
    #        foreach ($days as $day) {
    #            $quotedDays[] = "'$day'";
    #        }
    #        $this->Js->buffer("muncieEvents.populatedDates['$month'] = [" . implode(',', $quotedDays) . "];");
    #    }
    #}
    foreach ($populated as $monthYear => $days) {
        $this->Js->buffer("muncieEvents.populatedDates = " . json_encode($populated) . ";");
    }
    $this->Js->buffer("setupHeaderNav();");
?>
