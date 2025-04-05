protected function getBackgroundDetails()
    {
        return [
            'position'  => [
                '0 0'           => Translate::t('background.details.position.left_top', [], 'backgroundfield'),
                '50% 0'         => Translate::t('background.details.position.center_top', [], 'backgroundfield'),
                '100% 0'        => Translate::t('background.details.position.right_top', [], 'backgroundfield'),
                '0 50%'         => Translate::t('background.details.position.left_middle', [], 'backgroundfield'),
                '50% 50%'       => Translate::t('background.details.position.center_middle', [], 'backgroundfield'),
                '100% 50%'      => Translate::t('background.details.position.right_middle', [], 'backgroundfield'),
                '0 100%'        => Translate::t('background.details.position.left_bottom', [], 'backgroundfield'),
                '50% 100%'      => Translate::t('background.details.position.center_bottom', [], 'backgroundfield'),
                '100% 100%'     => Translate::t('background.details.position.right_bottom', [], 'backgroundfield'),
            ],
            'repeat'    => [
                'no-repeat'     => Translate::t('background.details.repeat.no_repeat', [], 'backgroundfield'),
                'repeat-x'      => Translate::t('background.details.repeat.repeat_x', [], 'backgroundfield'),
                'repeat-y'      => Translate::t('background.details.repeat.repeat_y', [], 'backgroundfield'),
                'repeat'        => Translate::t('background.details.repeat.repeat', [], 'backgroundfield'),
            ],
            'size'      => [
                'auto'          => [
                    'times',
                    Translate::t('background.details.size.auto', [], 'backgroundfield'),
                ],
                'cover'         => [
                    'arrows-h',
                    Translate::t('background.details.size.cover', [], 'backgroundfield'),
                ],
                'contain'       => [
                    'arrows',
                    Translate::t('background.details.size.contain', [], 'backgroundfield'),
                ],
            ],
        ];
    }