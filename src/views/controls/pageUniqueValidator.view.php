<filter:declare name="pageUnique">
    <filter:equals name="url" value="edit:url" />
    <filter:equals name="id" value="template:pageId" not="true" />
</filter:declare>
<cepage:list filter="filter:pageUnique">
    <cepage:register name="id" />
    <ui:any items="cepage:list">
        <val:add key="url" identifier="unique" />
    </ui:any>
</cepage:list>