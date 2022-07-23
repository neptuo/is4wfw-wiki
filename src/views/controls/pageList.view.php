<filter:declare name="page" alias="p">
    <filter:or>
        <filter:like name="content" contains="query:q" />
        <filter:like name="title" contains="query:q" />
    </filter:or>
    <login:authorized none="wiki">
        <filter:equals name="is_public" value="1" />
    </login:authorized>
    <template:content />
</filter:declare>

<edit:form submit="search">
    <ui:filter>
        <div class="form-row">
            <bs:column>
                <bs:formGroup field="q">
                    <div class="input-group mb-3">
                        <ui:textbox name="q" class="bs:fieldValidatorCssClass" placeholder="Search..." />
                        <div class="input-group-append">
                            <bs:button name="search">
                                <fa5:icon name="search" />
                                <span class="d-none d-md-inline">
                                    Search
                                </span>
                            </bs:button>
                            <web:a pageId="route:home" class="btn btn-secondary">
                                <span class="d-inline d-md-none">
                                    <fa5:icon name="times" />
                                </span>
                                <span class="d-none d-md-inline">
                                    Clear
                                </span>
                            </web:a>
                        </div>
                    </div>
                </bs:formGroup>
            </bs:column>
            <login:authorized any="wiki">
                <bs:column default="auto">
                    <web:a pageId="route:new" class="btn btn-success">
                        <fa5:icon name="plus" />
                        <span class="d-none d-md-inline">
                            New page
                        </span>
                    </web:a>
                </bs:column>
            </login:authorized>
        </div>
    </ui:filter>
</edit:form>

<ce:list name="page" filter="filter:page" orderBy-title="asc">
    <div class="list-group mb-4">
        <ui:empty items="ce:list">
            <div class="list-group-item">
                <fa5:icon name="battery-empty" />
                <span class="ml-2 text-secondary">
                    Nothing to show here...
                </span>
            </div>
        </ui:empty>
        <ui:any items="ce:list">
            <ce:register name="url" />
            <ui:forEach items="ce:list">
                <web:a pageId="route:page" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            <web:out text="ce:title" />
                        </h5>
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
                </web:a>
            </ui:forEach>
        </ui:any>
    </div>
</ce:list>