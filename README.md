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
{% for block in homepage.blocks %}
    <div class="container-fluid{% if block.no_gutters %} g-{% if block.no_gutters_breakpoint != "xs" %}{{ block.no_gutters_breakpoint }}-{% endif %}0{% endif %}{% if loop.index > 1 and block.padding_top %} pt-5{% endif %}{% if loop.last %} pb-5{% endif %} {{ block.type|slug }} {{ block.type|slug }}--{{ block.title|slug }}">
        <div class="container{% if block.is_fluid %}-fluid{% else %}-lg{% endif %}{% if block.no_gutters %} g-{% if block.no_gutters_breakpoint != "xs" %}{{ block.no_gutters_breakpoint }}-{% endif %}0{% endif %}{% if loop.index > 1 and block.padding_top %} pt-xl-4{% endif %}{% if loop.last %} pb-xl-4{% endif %}">
            {% if block.heading and block.type != "image_text" %}
                <h2 class="mb-5 text-center">
                    {{ block.heading }}
                </h2>
            {% endif %}

            {% if block.type == "slider" %}
                {% partial "_swiper/slider" slides=block.slider.slides settings=block.slider %}
            {% elseif block.type == "image_text" %}
                {% partial "_block/image-text.htm" image=block.image text=block.text heading=block.heading switched=block.switch_order size=lg %}
            {% elseif block.type == "embed" %}
                {% partial "_block/embed.htm" embed=block.embed %}
            {% elseif block.type == "posts" %}
                {% component "posts" categoryFilter=block.blog_category.slug rowCols=block.row_cols partial=block.partial %}
            {% elseif block.type == "posts_slider" %}
                {% component "postsslider" categoryFilter=block.blog_category.slug rowCols=block.row_cols %}
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

[staticMenu sidebarmenu]

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
order = "sort_order asc"

[pricelist]

[openinghours]
==
<?php
function onEnd()
{
    $code = $this["page"]->menu;

    $this["sidebarmenu"]->resetMenu($code);
}
?>
==
<div class="container-fluid" id="breadcrumb">
    <div class="container-lg">
        <div class="row g-5">
            <div class="col {% if sidebarmenu.menuItems is not null %}col-xl-9 offset-xl-3{% endif %}">
                {% component "breadcrumbs" %}
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5 border-1 border-bottom border-light" id="page">
    <div class="container-lg">
        <div class="row g-5">
            {% if sidebarmenu.menuItems is not null %}
                <div class="sidebar d-none d-xl-block col-xl-3">
                    {% component "sidebarmenu" %}
                </div>
            {% endif %}

            <div class="col {% if sidebarmenu.menuItems is not null %}col-xl-9{% endif %}">
                <h1 class="mb-4">
                    {{ page.title }}
                </h1>

                <div class="d-flex flex-column gap-5">
                    {% for content in page.contents %}
                        <div class="{{ content.type|slug }} {{ content.type|slug }}--{{ content.title|slug }}">
                            {% if content.heading and content.type != "image_text" %}
                                <h2 class="mb-4">
                                    {{ content.heading }}
                                </h2>
                            {% endif %}

                            {% if content.type == "text" %}
                                {{ content.text|raw|bootstrap }}
                            {% elseif content.type == "image_text" %}
                                {% partial "_block/image-text.htm" image=content.image text=content.text heading=content.heading switched=content.switch_order %}
                            {% elseif content.type == "blog" %}
                                {% component "posts" categoryFilter=content.blog_category.slug rowCols=content.row_cols partial=content.partial %}
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
