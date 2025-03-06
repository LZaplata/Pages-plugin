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

[contactForm contactform]
==
{% for block in homepage.blocks %}
    <div class="container-fluid{% if block.no_gutters %} g-{% if block.no_gutters_breakpoint != "xs" %}{{ block.no_gutters_breakpoint }}-{% endif %}0{% endif %}{% if loop.index > 1 and block.padding_top %} pt-5{% endif %}{% if loop.last %} pb-5{% endif %} {{ block.type|slug }} {{ block.type|slug }}--{{ block.title|slug }}">
        <div class="container{% if block.is_fluid %}-fluid{% else %}-lg{% endif %}{% if block.no_gutters %} g-{% if block.no_gutters_breakpoint != "xs" %}{{ block.no_gutters_breakpoint }}-{% endif %}0{% endif %}{% if loop.index > 1 and block.padding_top %} pt-xl-4{% endif %}{% if loop.last %} pb-xl-4{% endif %}">
            {% if block.heading and block.type != "image_text" %}
                <h2 class="mb-5 text-center">
                    {{ block.heading }}
                </h2>
            {% endif %}

            {% if block.type == "text" %}
                {{ block.text|content|bootstrap }}
            {% elseif block.type == "slider" %}
                {% partial "_swiper/slider" slides=block.slider.slides settings=block.slider %}
            {% elseif block.type == "image_text" %}
                {% partial "_block/image-text.htm" image=block.image text=block.text heading=block.heading switched=block.switch_order size=lg %}
            {% elseif block.type == "embed" %}
                {% partial "_block/embed.htm" embed=block.embed %}
            {% elseif block.type == "posts" %}
                {% component "posts" categoryFilter=block.blog_category.slug rowCols=block.row_cols partial=block.partial sortOrder=block.blog_sort_order moreButtonTitle=block.more_button_title moreButtonLink=block.more_button_link %}
            {% elseif block.type == "posts_slider" %}
                {% component "postsslider" categoryFilter=block.blog_category.slug rowCols=block.row_cols sortOrder=block.blog_sort_order moreButtonTitle=block.more_button_title moreButtonLink=block.more_button_link %}
            {% elseif block.type == "flash_message" %}
                {% component "flashmessage" categoryFilter=block.blog_category.slug %}
            {% elseif block.type == "partial" %}
                {% partial block.partial %}
            {% elseif block.type == "links" %}
                {% partial "_links/default" partial=block.partial row_cols=block.row_cols category=block.links_category %}
            {% elseif block.type == "links_slider" %}
                {% partial "_swiper/scrollable" items=block.links_category.links.toNested.lists("link") slides_per_view=block.row_cols partial=block.partial %}
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
seoOptionsMetaTitle = "{{ page.metaTitle ?: page.title }}"
seoOptionsMetaDescription = "{{ page.metaDescription }}"

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
categoryPage = "page"
postPage = "page-post"

[Files files]
order = "sort_order asc"

[pricelist]

[openinghours]

[contactForm contactform]
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
                                {{ content.text|content|bootstrap }}
                            {% elseif content.type == "image_text" %}
                                {% partial "_block/image-text.htm" image=content.image text=content.text heading=content.heading switched=content.switch_order %}
                            {% elseif content.type == "blog" %}
                                {% component "posts" categoryFilter=content.blog_category.slug rowCols=content.row_cols partial=content.partial sortOrder=content.blog_sort_order %}
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
                                {% partial "_contacts/default" partial=content.partial row_cols=content.row_cols %}
                            {% elseif content.type == "jobs" %}
                                {% partial "_jobs/default" partial=content.partial row_cols=content.row_cols post_page=content.post_page %}
                            {% elseif content.type == "links" %}
                                {% partial "_links/default" partial=content.partial row_cols=content.row_cols category=content.links_category %}
                            {% elseif content.type == "partial" %}
                                {% partial content.partial %}
                            {% endif %}
                        </div>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
</div>
````

## Example post page

````htm
url = "/:fullslug*/d/:slug"
layout = "default"
title = "Post"
seoOptionsMetaTitle = "{{ job ? job.title : (post ? post.title) }} | {{ page.title }}"

[section job]
handle = "Jobs\Job"
identifier = "slug"
value = "{{ :slug }}"

[breadcrumbs]
pageCode = "page"

[page]
column = "fullslug"
value = "{{ :fullslug }}"
==
<div class="container-fluid" id="breadcrumb">
    <div class="container-lg">
        <div class="row g-5">
            <div class="col">
                {% component "breadcrumbs" %}
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5 border-1 border-bottom border-light" id="page-post">
    <div class="container-lg">
        {% set job_post_partial = null %}

        {% for content in page.contents %}
            {% if content.type == "jobs" %}
                {% set job_post_partial = content.post_partial %}
            {% endif %}
        {% endfor %}

        {% if job %}
            {% partial job_post_partial post=job %}
        {% elseif post %}
            {% partial "_post/default" %}
        {% endif %}
    </div>
</div>
````
