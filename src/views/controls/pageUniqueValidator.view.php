<filter:declare name="pageUnique">
    <filter:equals name="url" value="edit:url" />
    <filter:equals name="id" value="template:pageId" not="true" />
    <filter:exists from="ce_folder" alias="f" outerColumn="folder_id" innerColumn="id" if:stringEmpty="template:folderId" if:not="true">
        <filter:equals name="id" value="template:folderId" />
    </filter:exists>
</filter:declare>
<cepage:list filter="filter:pageUnique">
    <cepage:register name="id" />
    <ui:any items="cepage:list">
        <val:add key="url" identifier="unique" />
    </ui:any>
</cepage:list>