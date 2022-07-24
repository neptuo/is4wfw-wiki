<filter:declare name="pageUnique">
    <filter:equals name="url" value="edit:url" />
    <filter:equals name="id" value="template:pageId" not="true" />
</filter:declare>
<ce:list name="page" filter="filter:pageUnique">
    <ce:register name="id" />
    <ui:any items="ce:list">
        <val:add key="url" identifier="unique" />
    </ui:any>
</ce:list>