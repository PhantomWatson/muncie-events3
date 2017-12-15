<fieldset class="col-md-5">
    <legend>Frequency</legend>
    <?php
        $formTemplate = [
            'inputContainer' => '{{content}}'
        ];
        $this->Form->setTemplates($formTemplate);
    ?>
    <?php echo $this->Form->input(
        'frequency',
        [
            'type' => 'radio',
            'options' => [
                'weekly' => 'Weekly (Thursday, next week\'s events)'
            ],
            'class' => 'frequency_options',
            'div' => [
                'class'=>'form-control mailing-options'
            ],
            'legend' => false,
            'label' => false,
            'hiddenField' => false,
            'selected' => true
        ]
    ); ?>
    <?php echo $this->Form->input(
        'frequency',
        [
            'type' => 'radio',
            'options' => [
                'daily' => 'Daily (Every morning, today\'s events)'
            ],
            'class' => 'frequency_options',
            'div' => [
                'class'=>'form-control mailing-options'
            ],
            'legend' => false,
            'hiddenField' => false,
            'label' => false
        ]
    ); ?>
    <?php echo $this->Form->input(
        'frequency',
        [
            'type' => 'radio',
            'options' => [
                'custom' => 'Custom'
            ],
            'class' => 'frequency_options',
            'div' => [
                'class'=>'form-control mailing-options'
            ],
            'legend' => false,
            'hiddenField' => false,
            'label' => false
        ]
    ); ?>
    <div id="custom_frequency_options">
        <?php if (isset($frequency_error)): ?>
            <div class="error">
                <?= $frequency_error; ?>
            </div>
        <?php endif; ?>
        <table>
            <tr>
                <th>
                    Weekly:
                </th>
                <td>
                    <?= $this->Form->input(
                        'weekly',
                        [
                            'type' => 'checkbox',
                            'label' => ' Thursday'
                        ]
                    ); ?>
                </td>
            </tr>
            <tr>
                <th>
                    Daily:
                </th>
                <td>
                    <?php foreach ($days as $code => $day): ?>
                        <?= $this->Form->input(
                            "daily_$code",
                            [
                                'type' => 'checkbox',
                                'label' => false,
                                'id' => 'daily_'.$code
                            ]
                        ); ?>
                        <label for="daily_<?= $code; ?>">
                            <?= $day; ?>
                        </label>
                        <br />
                    <?php endforeach; ?>
                </td>
            </tr>
        </table>
    </div>
</fieldset>
