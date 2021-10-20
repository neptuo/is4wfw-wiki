<module:assets path="github-markdown-light.css">
    <js:style path="module:assets" />
</module:assets>

<login:authorized any="wiki">
    <web:condition when="post:delete">
        <ce:deleter name="page" url="template:url">
            <var:declare name="message" scope="temp" value="Page has been deleted." />
            <web:redirectTo pageId="route:home" />
        </ce:deleter>
    </web:condition>
</login:authorized>
<filter:declare name="detail" alias="p">
    <filter:equals name="url" value="template:url" />
    <login:authorized none="wiki">
        <filter:equals name="is_public" value="1" />
    </login:authorized>
</filter:declare>
<ce:list name="page" filter="filter:detail">
    <ui:empty items="ce:list">
        Not found
    </ui:empty>
    <ui:first items="ce:list">
        <template:title value="ce:title" />
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 text-truncate">
                <h1 class="mb-0 text-truncate">
                    <web:out text="ce:title" />
                </h1>
            </div>
            <login:authorized any="wiki">
                <div>
                    <web:a pageId="route:edit" class="btn btn-primary text-nowrap">
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
                <fa5:icon prefix="far" name="clock" title="Changed at" />
                <ui:dateTimeValue value="ce:changed_date" format="d.m.Y H:i:s" />
            </small>
            <web:condition when="ce:is_public">
                <small class="mr-1">
                    <fa5:icon name="user-secret" />
                    Public
                </small>
            </web:condition>
        </div>
        <hr>
        <div class="markdown-body">
            <md:render source="ce:content" />
        </div>
    </ui:first>
</ce:list>