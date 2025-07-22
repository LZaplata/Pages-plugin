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
            'update' => [
                'label' => 'Upravit',
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
                'blog_category' => [
                    'label' => 'Kategorie příspěvků',
                ],
                'files_category' => [
                    'label' => 'Kategorie souborů',
                ],
                'contacts_category' => [
                    'label' => 'Kategorie kontaktů',
                ],
                'jobs_category' => [
                    'label' => 'Kategorie volných pozic',
                ],
                'links_category' => [
                    'label' => 'Kategorie odkazů',
                ],
                'partial' => [
                    'label' => 'Šablona',
                ],
                'row_cols' => [
                    'label' => 'Počet příspěvků na řádek',
                ],
                'blog_sort_order' => [
                    'label' => 'Řazení příspěvků',
                ],
                'gallery' => [
                    'label' => 'Galerie',
                ],
                'pricelist' => [
                    'label' => 'Ceník',
                ],
                'opening_hours' => [
                    'label' => 'Otevírací hodiny',
                ],
                'slider' => [
                    'label' => 'Slider',
                ],
            ],
            'delete' => [
                'label' => 'Smazat',
            ],
            'reorder' => [
                'label' => 'Změnit pořadí',
            ],
        ],
        'homepage' => [
            'label' => 'Úvod',
        ],
        'block' => [
            'label' => 'Bloky',
            'create' => [
                'label' => 'Vytvořit',
            ],
            'update' => [
                'label' => 'Upravit',
            ],
            'delete' => [
                'label' => 'Smazat',
            ],
            'reorder' => [
                'label' => 'Změnit pořadí',
            ],
        ],
        'structure' => [
            'label' => 'Struktura',
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
            'meta_title' => [
                'label' => 'Titulek',
                'comment' => 'Pokud nevyplníte, použije se název stránky.',
            ],
            'meta_description' => [
                'label' => 'Popisek',
            ],
        ],
        'tab' => [
            'meta' => [
                'label' => 'Meta',
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
                    'opening_hours' => [
                        'label' => 'Otevírací hodiny',
                    ],
                    'slider' => [
                        'label' => 'Slider',
                    ],
                    'embed' => [
                        'label' => 'Vložený prvek (embed)',
                    ],
                    'image_text' => [
                        'label' => 'Obrázek s textem',
                    ],
                    'jobs' => [
                        'label' => 'Volné pozice',
                    ],
                    'links' => [
                        'label' => 'Odkazy',
                    ],
                    'partial' => [
                        'label' => 'Šablona',
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
                'empty_option' => '-- Nerozhoduje --',
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
            'opening_hours' => [
                'label' => 'Otevírací hodiny',
            ],
            'slider' => [
                'label' => 'Slider',
            ],
            'embed' => [
                'label' => 'Kód iframe',
            ],
            'partial' => [
                'label' => 'Šablona',
            ],
            'row_cols' => [
                'label' => 'Počet příspěvků na řádek',
            ],
            'items_per_page' => [
                'label' => 'Počet příspěvků na stránku',
            ],
            'image' => [
                'label' => 'Obrázek',
            ],
            'switch_order' => [
                'label' => 'Prohodit pořadí',
            ],
            'jobs_categories' => [
                'label' => 'Kategorie',
            ],
            'post_partial' => [
                'label' => 'Šablona příspěvku',
            ],
            'links_categories' => [
                'label' => 'Kategorie',
            ],
            'blog_sort_order' => [
                'label' => 'Řazení příspěvků',
            ],
            'variables' => [
                'label' => 'Proměnné',
                'prompt' => 'Přidat novou proměnnou',
                'field' => [
                    'name' => [
                        'label' => 'Název',
                    ],
                    'type' => [
                        'label' => 'Typ',
                        'option' => [
                            'text' => [
                                'label' => 'Text',
                            ],
                            'link' => [
                                'label' => 'Odkaz',
                            ],
                        ],
                    ],
                    'value' => [
                        'label' => 'Hodnota',
                    ],
                    'link' => [
                        'label' => 'Odkaz',
                    ]
                ],
            ],
        ],
        'create' => [
            'title' => 'Vytvořit obsah',
        ],
        'update' => [
            'title' => 'Upravit obsah',
        ],
    ],
    'block' => [
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
            'title' => [
                'label' => 'Název',
                'comment' => 'Interní název pro zobrazení v administraci. Nebude se zobrazovat na webu.',
            ],
            'heading' => [
                'label' => 'Nadpis',
                'comment' => 'Nadpis obsahu na webu',
            ],
            'is_fluid' => [
                'label' => 'Na celou šířku',
            ],
            'no_gutters' => [
                'label' => 'Bez okrajů',
            ],
            'no_gutters_breakpoint' => [
                'label' => 'Bez okrajů od šířky',
            ],
            'padding_top' => [
                'label' => 'Odsazení zhora',
            ],
            'sort_order' => [
                'label' => 'Pořadí',
            ],
            'is_published' => [
                'label' => 'Publikováno',
            ],
            'text' => [
                'label' => 'Text',
            ],
            'image' => [
                'label' => 'Obrázek',
            ],
            'blog_category' => [
                'label' => 'Kategorie příspěvků',
                'empty_option' => '-- Nerozhoduje --',
            ],
            'partial' => [
                'label' => 'Šablona',
            ],
            'row_cols' => [
                'label' => 'Počet příspěvků na řádek',
            ],
            'items_per_page' => [
                'label' => 'Celkový počet příspěvků',
            ],
            'switch_order' => [
                'label' => 'Prohodit pořadí',
            ],
            'slider' => [
                'label' => 'Slider',
            ],
            'embed' => [
                'label' => 'Kód iframe',
            ],
            'links_category' => [
                'label' => 'Kategorie odkazů',
            ],
            'blog_sort_order' => [
                'label' => 'Řazení příspěvků',
            ],
            'more_button_is_published' => [
                'label' => 'Tlačítko "Zobrazit více"',
            ],
            'more_button_title' => [
                'label' => 'Titulek tlačítka "Zobrazit více"',
            ],
            'more_button_link' => [
                'label' => 'Stránka příspěvků',
            ],
            'variables' => [
                'label' => 'Proměnné',
                'prompt' => 'Přidat novou proměnnou',
                'field' => [
                    'name' => [
                        'label' => 'Název',
                    ],
                    'type' => [
                        'label' => 'Typ',
                        'option' => [
                            'text' => [
                                'label' => 'Text',
                            ],
                            'link' => [
                                'label' => 'Odkaz',
                            ],
                        ],
                    ],
                    'value' => [
                        'label' => 'Hodnota',
                    ],
                    'link' => [
                        'label' => 'Odkaz',
                    ]
                ],
            ],
            'type' => [
                'label' => 'Typ',
                'option' => [
                    'posts' => [
                        'label' => 'Příspěvky',
                    ],
                    'posts_slider' => [
                        'label' => 'Slider příspěvků',
                    ],
                    'partial' => [
                        'label' => 'Vlastní šablona',
                    ],
                    'image_text' => [
                        'label' => 'Obrázek s textem',
                    ],
                    'flash_message' => [
                        'label' => 'Rychlá zpráva',
                    ],
                    'embed' => [
                        'label' => 'Vložený prvek (embed)',
                    ],
                    'links' => [
                        'label' => 'Odkazy',
                    ],
                    'links_slider' => [
                        'label' => 'Slider odkazů',
                    ],
                ],
            ],
        ],
        'create' => [
            'title' => 'Vytvořit blok',
            'flash' => 'Blok byl úspěšně vytvořen',
        ],
        'update' => [
            'title' => 'Upravit blok',
            'flash' => 'Blok byl úspěšně upraven',
        ],
        'delete' => [
            'flash' => 'Blok byl úspěšně smazán',
        ],
    ],
    'menuitem' => [
        'listtype' => [
            'page' => [
                'label' => 'Stránka',
            ],
        ],
        'submenu' => [
            'structure' => [
                'label' => 'Struktura',
            ],
            'homepage' => [
                'label' => 'Úvod',
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
        'homepage' => [
            'name' => 'Úvod',
            'description' => 'Komponenta pro vložení proměnných úvodní stránky do tématu',
        ],
    ],
];
