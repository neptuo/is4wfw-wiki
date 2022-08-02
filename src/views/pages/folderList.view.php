<filter:declare name="folder" alias="f">
    <filter:or>
        <filter:like name="name" contains="query:q" />
    </filter:or>
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
                            <web:a pageId="route:folderList" class="btn btn-secondary">
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
                    <web:a pageId="route:folderNew" class="btn btn-success">
                        <fa5:icon name="plus" />
                        <span class="d-none d-md-inline">
                            New folder
                        </span>
                    </web:a>
                </bs:column>
            </login:authorized>
        </div>
    </ui:filter>
</edit:form>

<cefolder:list name="folder" filter="filter:folder" orderBy-name="asc">
    <div class="list-group mb-4">
        <ui:empty items="cefolder:list">
            <div class="list-group-item">
                <fa5:icon name="battery-empty" />
                <span class="ml-2 text-secondary">
                    Nothing to show here...
                </span>
            </div>
        </ui:empty>
        <ui:any items="cefolder:list">
            <cefolder:register name="url" />
            <ui:forEach items="cefolder:list">
                <web:a pageId="route:folder" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            <web:out text="cefolder:name" />
                        </h5>
                    </div>
                    <div>
                        <small class="mr-1">
                            <paging:container size="1000">
                                <ce:list name="page" filter-folder_id="cefolder:id" paging="paging:container">
                                    <fa5:icon prefix="fas" name="copy" />
                                    <ui:count items="ce:list" />
                                    <controls:plural value="paging:totalCount" singular="page" />
                                </ce:list>
                            </paging:container>
                        </small>
                        <small class="mr-1">
                            <fa5:icon prefix="far" name="clock" title="Created at" />
                            <ui:dateTimeValue value="cefolder:created_date" format="d.m.Y H:i:s" />
                        </small>
                    </div>
                </web:a>
            </ui:forEach>
        </ui:any>
    </div>
</cefolder:list>