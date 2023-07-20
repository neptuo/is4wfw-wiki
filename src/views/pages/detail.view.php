<module:assets path="github-markdown-light.css">
    <js:style path="module:assets" />
</module:assets>

<login:authorized any="wiki">
    <web:condition when="post:delete">
        <cepage:deleter url="template:url">
            <var:declare name="message" scope="temp" value="Page has been deleted." />
            <web:redirectTo pageId="route:home" />
        </cepage:deleter>
    </web:condition>
</login:authorized>
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
        <controls:stickyHeader>
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 text-truncate">
                    <h1 class="mb-0 text-truncate">
                        <web:out text="cepage:title" />
                    </h1>
                </div>
                <login:authorized any="wiki">
                    <div>
                        <controls:pageLink folderUrl="cepage:folder_id.url" type="history" class="btn btn-secondary text-nowrap">
                            <fa5:icon prefix="fas" name="history" />
                            <span class="d-none d-md-inline">
                                History
                            </span>
                        </controls:pageLink>
                    </div>
                    <div class="ml-2">
                        <controls:pageLink folderUrl="cepage:folder_id.url" type="files" class="btn btn-secondary text-nowrap">
                            <fa5:icon name="file" />
                            <span class="d-none d-md-inline">
                                Files
                            </span>
                        </controls:pageLink>
                    </div>
                    <div class="ml-2">
                        <controls:pageLink folderUrl="cepage:folder_id.url" type="edit" class="btn btn-primary text-nowrap">
                            <fa5:icon name="pen" />
                            <span class="d-none d-md-inline">
                                Edit
                            </span>
                        </controls:pageLink>
                    </div>
                    <div class="ml-2">
                        <ui:form class="form-inline">
                            <bs:button color="danger" name="delete" value="delete" class="text-nowrap">
                                <fa5:icon name="trash-alt" />
                                <span class="d-none d-md-inline">
                                    Delete
                                </span>
                            </bs:button>
                        </ui:form>
                    </div>
                </login:authorized>
            </div>
            <div>
                <web:condition when="cepage:folder_id.name">
                    <fa5:icon prefix="fas" name="folder" title="Folder" />
                    <web:out text="cepage:folder_id.name" />
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
        </controls:stickyHeader>
        <div class="markdown-body">
            <md:render source="cepage:content" />
        </div>
    </ui:first>
</cepage:list>