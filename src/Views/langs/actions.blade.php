@include('components.actions-bar', [
    'groups' => [
        // 'group-1' => [],
        'group-2' => [
            'add-lang' => (object)  [
                'label' => 'New',
                'icon' => 'fas fa-plus',
            ],
        ],
    ]
])
