<module:assets path="github-markdown-light.css">
    <js:style path="module:assets" />
</module:assets>

<filter:declare name="detail" alias="p">
    <filter:equals name="url" value="template:url" />
    <login:authorized none="wiki">
        <filter:equals name="is_public" value="1" />
    </login:authorized>
</filter:declare>
<cepage:list filter="filter:detail">
    <cepage:register name="folder_id.url" />
    <cepage:register name="folder_id.name" />
    <cepage:register name="is_public" />
    <cepage:register name="changed_date" />
    <ui:empty items="cepage:list">
        Not found
    </ui:empty>
    <ui:first items="cepage:list">
        <template:title value="cepage:title" />
        <controls:pageHeader />
        <div class="markdown-body px-2">
            <md:render source="cepage:content" />
        </div>
    </ui:first>
</cepage:list>