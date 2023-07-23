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
    <ui:empty items="cepage:list">
        Not found
    </ui:empty>
    <ui:first items="cepage:list">
        <template:title value="cepage:title" />
        <controls:stickyHeader separator="false">
            <div class="text-truncate px-2 pb-2 pb-sm-0">
                <h1 class="mb-0 text-truncate">
                    <web:out text="cepage:title" />
                </h1>
            </div>
            <div class="d-block d-sm-flex align-items-end">
                <div class="flex-grow-1 border-bottom pb-2 px-2 d-none d-sm-block">
                    <div class="">
                        <web:condition when="cepage:folder_id.name">
                            <small class="mr-1">
                                <fa5:icon prefix="fas" name="folder" title="Folder" />
                                <web:out text="cepage:folder_id.name" />
                            </small>
                        </web:condition>
                        <small class="mr-1">
                            <fa5:icon prefix="far" name="clock" title="Changed at" />
                            <ui:dateTimeValue value="cepage:changed_date" format="d.m.Y H:i:s" />
                        </small>
                        <web:condition when="cepage:is_public">
                            <small class="mr-1">
                                <fa5:icon name="user-secret" />
                                Public
                            </small>
                        </web:condition>
                    </div>
                </div>
                <bs:nav mode="tabs">
                    <controls:pageUrl folderUrl="cepage:folder_id.url" type="view">
                        <bs:navItem url="template:pageUrl" isActive="true">
                            <fa5:icon name="eye" />
                            <span class="d-none d-md-inline">
                                View
                            </span>
                        </bs:navItem>
                    </controls:pageUrl>
                    <login:authorized any="wiki">
                        <controls:pageUrl folderUrl="cepage:folder_id.url" type="edit">
                            <bs:navItem url="template:pageUrl">
                                <fa5:icon name="pen" />
                                <span class="d-none d-md-inline">
                                    Edit
                                </span>
                            </bs:navItem>
                        </controls:pageUrl>
                        <controls:pageUrl folderUrl="cepage:folder_id.url" type="history">
                            <bs:navItem url="template:pageUrl">
                                <fa5:icon prefix="fas" name="history" />
                                <span class="d-none d-md-inline">
                                    History
                                </span>
                            </bs:navItem>
                        </controls:pageUrl>
                        <controls:pageUrl folderUrl="cepage:folder_id.url" type="files">
                            <bs:navItem url="template:pageUrl">
                                <fa5:icon name="file" />
                                <span class="d-none d-md-inline">
                                    Files
                                </span>
                            </bs:navItem>
                        </controls:pageUrl>
                        <controls:pageUrl folderUrl="cepage:folder_id.url" type="delete">
                            <bs:navItem url="template:pageUrl" a-class="text-danger">
                                <fa5:icon name="trash-alt" />
                                <span class="d-none d-md-inline">
                                    Delete...
                                </span>
                            </bs:navItem>
                        </controls:pageUrl>
                    </login:authorized>
                </bs:nav>
            </div>
        </controls:stickyHeader>
        <div class="markdown-body px-2">
            <md:render source="cepage:content" />
        </div>
    </ui:first>
</cepage:list>