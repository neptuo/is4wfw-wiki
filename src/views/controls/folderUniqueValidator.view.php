<filter:declare name="folderUnique">
    <filter:equals name="url" value="edit:url" />
    <filter:equals name="id" value="template:folderId" not="true" />
</filter:declare>
<ce:list name="folder" filter="filter:folderUnique">
    <ce:register name="id" />
    <ui:any items="ce:list">
        <val:add key="url" identifier="unique" />
    </ui:any>
</ce:list>