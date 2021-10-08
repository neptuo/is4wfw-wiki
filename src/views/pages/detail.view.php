<web:condition when="post:delete">
    <ce:deleter name="page" url="template:url">
        <var:declare name="message" scope="temp" value="Page has been deleted." />
        <web:redirectTo pageId="route:home" />
    </ce:deleter>
</web:condition>
<ce:list name="page" filter-url="template:url">
    <ui:empty items="ce:list">
        Not found
    </ui:empty>
    <ui:first items="ce:list">
        <template:title value="ce:title" />
        <div class="d-flex align-items-center">
            <div class="flex-grow-1">
                <h1>
                    <web:out text="ce:title" />
                </h1>
            </div>
            <login:authorized any="wiki">
                <div>
                    <web:a pageId="route:edit" class="btn btn-primary">
                        <fa5:icon name="pen" />
                        <span class="d-none d-md-inline">
                            Edit
                        </span>
                    </web:a>
                </div>
                <div class="ml-2">
                    <ui:form class="form-inline">
                        <bs:button color="danger" name="delete" value="delete">
                            <fa5:icon name="trash-alt" />
                            <span class="d-none d-md-inline">
                                Delete
                            </span>
                        </bs:button>
                    </ui:form>
                </div>
            </login:authorized>
        </div>
        <hr>
        <md:render source="ce:content" />
    </ui:first>
</ce:list>