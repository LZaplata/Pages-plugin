<?php return [
    'plugin' => [
        'name' => 'Stránky',
        'description' => 'Plugin pro správu stránek a jejich obsahu',
    ],
    'permission' => [
        'default' => 'Přístup k pluginu',
        'page' => [
            'label' => 'Stránky',
            'create' => [
                'label' => 'Vytvořit',
            ],
            'delete' => [
                'label' => 'Smazat',
            ],
            'reorder' => [
                'label' => 'Změnit pořadí',
            ],
        ],
        'content' => [
            'label' => 'Obsah',
            'create' => [
                'label' => 'Vytvořit',
            ],
            'update' => [
                'label' => 'Upravit',
                'type' => [
                    'label' => 'Typ',
                ],
            ],
            'delete' => [
                'label' => 'Smazat',
            ],
            'reorder' => [
                'label' => 'Změnit pořadí',
            ],
        ],
    ],
    'page' => [
        'column' => [
            'title' => [
                'label' => 'Název',
            ],
            'sort_order' => [
                'label' => 'Pořadí',
            ],
        ],
        'field' => [
            'contents' => [
                'label' => 'Obsah',
            ],
            'title' => [
                'label' => 'Název',
            ],
            'slug' => [
                'label' => 'URL',
            ],
            'parent' => [
                'label' => 'Nadřazená stránka',
                'prompt' => '--Žádná--',
            ],
            'sort_order' => [
                'label' => 'Pořadí',
            ],
            'fullslug' => [
                'label' => 'Celá URL',
            ],
            'breadcrumb' => [
                'label' => 'URL drobečkové navigace',
                'option' => [
                    'auto' => 'Automatická',
                    'manual' => 'Manualní',
                ],
            ],
            'menu' => [
                'label' => 'Menu',
                'prompt' => '--Žádné--',
            ],
        ],
        'create' => [
            'title' => 'Vytvořit stránku',
            'flash' => 'Stránka byla úspěšně vytvořena',
        ],
        'update' => [
            'title' => 'Upravit stránku',
            'flash' => 'Stránka byla úspěšně upravena',
        ],
        'delete' => [
            'flash' => 'Stránka byla úspěšně smazána',
        ],
    ],
    'content' => [
        'column' => [
            'title' => [
                'label' => 'Název',
            ],
            'type' => [
                'label' => 'Typ',
            ],
            'sort_order' => [
                'label' => 'Pořadí',
            ],
            'is_published' => [
                'label' => 'Publikováno',
            ],
        ],
        'field' => [
            'is_published' => [
                'label' => 'Publikováno',
            ],
            'title' => [
                'label' => 'Název',
                'comment' => 'Interní název pro zobrazení v administraci. Nebude se zobrazovat na webu.',
            ],
            'type' => [
                'label' => 'Typ',
                'option' => [
                    'blog' => [
                        'label' => 'Blog',
                    ],
                    'gallery' => [
                        'label' => 'Galerie',
                    ],
                    'files' => [
                        'label' => 'Soubory',
                    ],
                    'contacts' => [
                        'label' => 'Kontakty',
                    ],
                    'cookies' => [
                        'label' => 'Nastavení cookies',
                    ],
                    'pricelist' => [
                        'label' => 'Ceník',
                    ],
                ],
            ],
            'text' => [
                'label' => 'Text',
            ],
            'heading' => [
                'label' => 'Nadpis',
                'comment' => 'Nadpis obsahu na webu',
            ],
            'sort_order' => [
                'label' => 'Pořadí',
            ],
            'blog_categories' => [
                'label' => 'Kategorie',
            ],
            'gallery' => [
                'label' => 'Galerie',
                'prompt' => '--Vybrat--',
            ],
            'files_categories' => [
                'label' => 'Kategorie',
            ],
            'contacts_categories' => [
                'label' => 'Kategorie',
            ],
            'pricelist' => [
                'label' => 'Ceník',
            ],
        ],
        'create' => [
            'title' => 'Vytvořit obsah',
        ],
        'update' => [
            'title' => 'Upravit obsah',
        ],
    ],
    'menuitem' => [
        'listtype' => [
            'page' => [
                'label' => 'Stránka',
            ],
        ],
    ],
    'component' => [
        'page' => [
            'name' => 'Stránka',
            'description' => 'Komponenta pro vložení proměnných stránky do tématu',
            'column' => [
                'title' => 'Sloupec',
                'description' => 'Název sloupce (index) pro párování s primárním záznamem.',
            ],
            'value' => [
                'title' => 'Hodnota',
                'description' => 'URL kód (slug) použitý k vyhledání primárního záznamu.',
            ],
        ],
        'breadcrumbs' => [
            'name' => 'Drobečková navigace',
            'description' => 'Komponenta pro vložení drobečkové navigace',
        ],
    ],
];
