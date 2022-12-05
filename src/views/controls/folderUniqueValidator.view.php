<filter:declare name="folderUnique">
    <filter:equals name="url" value="edit:url" />
    <filter:equals name="id" value="template:folderId" not="true" />
</filter:declare>
<cefolder:list filter="filter:folderUnique">
    <cefolder:register name="id" />
    <ui:any items="cefolder:list">
        <val:add key="url" identifier="unique" />
    </ui:any>
</cefolder:list>