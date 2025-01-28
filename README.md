# Pages plugin
This is plugin for creating pages and managing its content.

## Example homepage

````htm
url = "/"
layout = "default"
title = "Úvod"

[collection partners]
handle = "Partners\Partner"

[homepage]

[blogPosts flashmessage]
postsPerPage = 1
sortOrder = "published_at desc"

[blogPosts posts]

[blogPosts postsslider]
==
<?php
function onEnd()
{
    $blocks = $this["homepage"]->blocks;

    if (!is_null($blocks)) {
        $blockTypes = [
            "flash_message" => "flashmessage",
            "posts"         => "posts",
            "posts_slider"  => "postsslider",
        ];

        foreach ($blocks as $block) {
            if (isset($blockTypes[$block->type])) {
                ${"block" . $block->id} = $this->page->components[$blockTypes[$block->type]];
                ${"block" . $block->id}->setProperty("categoryFilter", $block->blog_category->slug);
                ${"block" . $block->id}->setProperty("rowCols", $block->row_cols);
                ${"block" . $block->id}->onRun();
            }
        }
    }
}
?>
==
{% for block in homepage.blocks %}
    <div class="container-fluid{% if block.no_gutters %} g-{% if block.no_gutters_breakpoint != "xs" %}{{ block.no_gutters_breakpoint }}-{% endif %}0{% endif %}{% if loop.index > 1 and block.padding_top %} pt-5{% endif %} {{ block.type }} {{ block.type }}--{{ block.title|slug }}">
        <div class="container{% if block.is_fluid %}-fluid{% else %}-lg{% endif %}{% if block.no_gutters %} g-{% if block.no_gutters_breakpoint != "xs" %}{{ block.no_gutters_breakpoint }}-{% endif %}0{% endif %}{% if loop.index > 1 and block.padding_top %} pt-xl-4{% endif %}">
            {% if block.heading and block.type != "image_text" %}
                <h2 class="mb-5 text-center">
                    {{ block.heading }}
                </h2>
            {% endif %}

            {% if block.type == "slider" %}
                {% partial "_swiper/slider" slides=block.slider.slides settings=block.slider %}
            {% elseif block.type == "image_text" %}
                {% partial "_block/image-text.htm" image=block.image text=block.text heading=block.heading switched=block.switch_order %}
            {% elseif block.type == "embed" %}
                {% partial "_block/embed.htm" embed=block.embed %}
            {% elseif block.type == "posts" %}
                {% component "posts" %}
            {% elseif block.type == "posts_slider" %}
                {% component "postsslider" %}
            {% elseif block.type == "flash_message" %}
                {% component "flashmessage" %}
            {% elseif block.type == "partial" %}
                {% partial block.partial %}
            {% endif %}
        </div>
    </div>
{% endfor %}
````

## Example page

````htm
url = "/:fullslug*"
layout = "default"
title = "Page"
seoOptionsMetaTitle = "{{ page.title }}"

[page]
column = "fullslug"
value = "{{ :fullslug }}"

[Gallery gallery]
imagesPerPage = 16

[staticMenu leftmenu]

[breadcrumbs]

[collection faq]
handle = "FAQ\Question"

[cookiesManage cookiesmanage]

[blogPosts posts]
pageNumber = "{{ :page }}"
postsPerPage = 10
noPostsMessage = "Nenalezeny žádné příspěvky"
sortOrder = "published_at asc"
categoryPage = "page"
postPage = "page-post"

[Files files]
order = "position asc"

[pricelist]

[openinghours]
==
<?php
function onEnd()
{
    $code = $this["page"]->menu;
    $contents = $this["page"]->contents;

    $this["leftmenu"]->resetMenu($code);

    if (!is_null($contents)) {
        foreach ($contents as $content) {
            if ($content->type == "blog") {
                $posts = $this->page->components["posts"];
                $posts->setProperty("categoryFilter", $content->blog_category);
                $posts->onRun();
            }
        }
    }
}
?>
==
<div class="container-fluid mt-4">
    <div class="container-lg">
        <div class="row g-5">
            <div class="col {% if leftmenu.menuItems is not null %}col-xl-9 offset-xl-3{% endif %}">
                {% component "breadcrumbs" %}
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5 border-1 border-bottom border-light" id="page">
    <div class="container-lg">
        <div class="row g-5">
            {% if leftmenu.menuItems is not null %}
                <div class="sidebar d-none d-xl-block col-xl-3">
                    {% component "leftmenu" %}
                </div>
            {% endif %}

            <div class="col {% if leftmenu.menuItems is not null %}col-xl-9{% endif %}">
                <h1 class="mb-4">
                    {{ page.title }}
                </h1>

                <div class="d-flex flex-column gap-5">
                    {% for content in page.contents %}
                        <div class="{{ content.type|slug }} {{ content.type|slug }}--{{ content.title|slug }}">
                            {% if content.heading %}
                                <h2 class="mb-4">
                                    {{ content.heading }}
                                </h2>
                            {% endif %}

                            {% if content.type == "text" %}
                                {{ content.text|raw|bootstrap }}
                            {% elseif content.type == "blog" %}
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 {% if leftmenu.menuItems is null %}row-cols-xl-4{% endif %} g-4">
                                    {% component "posts" %}
                                </div>
                            {% elseif content.type == "gallery" %}
                                {% component "gallery" gallery=content.gallery.slug %}
                            {% elseif content.type == "files" %}
                                {% component "files" category=content.files_category.slug %}
                            {% elseif content.type == "pricelist" %}
                                {% component "pricelist" slug=content.pricelist.slug %}
                            {% elseif content.type == "opening_hours" %}
                                {% component "openinghours" slug=content.opening_hours.slug %}
                            {% elseif content.type == "faq" %}
                                {% partial "_accordion/faq" items=faq %}
                            {% elseif content.type == "slider" %}
                                {% partial "_swiper/slider" slides=content.slider.slides settings=content.slider %}
                            {% elseif content.type == "embed" %}
                                {% partial "_block/embed" embed=content.embed %}
                            {% elseif content.type == "cookies" %}
                                {% component "cookiesmanage" %}
                            {% elseif content.type == "contacts" %}
                                {% set fluid = sidebarmenu.menuItems is null ? true : false %}

                                {% partial "_contacts/default" partial=content.partial fluid=fluid %}
                            {% endif %}
                        </div>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
</div>
````
