<login:authorized any="wiki">
    <web:condition when="post:delete">
        <cefolder:deleter name="page" url="template:url">
            <var:declare name="message" scope="temp" value="Folder has been deleted." />
            <web:redirectTo pageId="route:folderList" />
        </cefolder:deleter>
    </web:condition>
</login:authorized>
<filter:declare name="detail" alias="f">
    <filter:equals name="url" value="template:url" />
</filter:declare>
<cefolder:list name="folder" filter="filter:detail">
    <ui:empty items="cefolder:list">
        Not found
    </ui:empty>
    <ui:first items="cefolder:list">
        <template:title value="cefolder:name" />
        <controls:stickyHeader separator="false">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 text-truncate">
                    <h1 class="mb-0 text-truncate">
                        <web:out text="cefolder:name" />
                    </h1>
                </div>
                <login:authorized any="wiki">
                    <div class="ml-2">
                        <web:a pageId="route:folderEdit" class="btn btn-primary text-nowrap">
                            <fa5:icon name="pen" />
                            <span class="d-none d-md-inline">
                                Edit
                            </span>
                        </web:a>
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
                <small class="mr-1">
                    <fa5:icon prefix="far" name="clock" title="Created at" />
                    <ui:dateTimeValue value="cefolder:created_date" format="d.m.Y H:i:s" />
                </small>
            </div>
        </controls:stickyHeader>
        <controls:pageList search="false">
            <filter:equals name="folder_id" value="cefolder:id" />
        </controls:pageList>
    </ui:first>
</cefolder:list>