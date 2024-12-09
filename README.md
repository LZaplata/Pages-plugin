# Pages plugin
This is Nette Framework extension for ESA logistics.

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

                <div class="contents d-flex flex-column gap-5">
                    {% for content in page.contents %}
                        <div class="content content-{{ content.type }} {{ content.title|slug }}">
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
                            {% elseif content.type == "faq" %}
                                {% partial "_accordion/faq" items=faq %}
                            {% elseif content.type == "cookies" %}
                                {% component "cookiesmanage" %}
                            {% elseif content.type == "contacts" %}
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 {% if leftmenu.menuItems is null %}row-cols-xl-5{% else %}row-cols-xl-4{% endif %} g-4">
                                    {% for contact in content.contacts_category.contacts %}
                                        <div class="col">
                                            {% partial "_contact/card" item=contact %}
                                        </div>
                                    {% endfor %}
                                </div>
                            {% endif %}
                        </div>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
</div>
````