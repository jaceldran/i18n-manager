@include('components.actions-bar', [
    'groups' => [
        'group-1' => [
            'open-all' => (object) [
                'label' => 'Open',
                'icon' => 'fas fa-angle-down',
            ],
            'close-all' => (object) [
                'label' => 'Close',
                'icon' => 'fas fa-angle-up',
            ],
        ],
        'group-2' => [
            'import' => (object) [
                'label' => 'Import',
                'icon' => 'fas fa-arrow-right-to-bracket',
            ],
            'export' => (object) [
                'label' => 'Export',
                'icon' => 'fas fa-arrow-right-from-bracket',
            ],
            'download' => (object) [
                'label' => 'Download',
                'icon' => 'fas fa-download',
            ],
            'render-create' => (object) [
                'label' => 'New',
                'icon' => 'fas fa-plus --w-8 --h-8 --bg-gray-200 --rounded-full',
                '--icon_style' => 'line-height: 2rem',
            ],
        ],
    ],
])
