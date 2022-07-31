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
                    Revision history
                </h1>
            </div>
            <div>
                <controls:pageLink folderUrl="ce:folder_id.url" class="btn btn-primary text-nowrap">
                    View current
                </controls:pageLink>
            </div>
        </div>
        <div class="mt-4">
            <cehistory:list name="pagehistory" filter-id="ce:id" orderBy-created_date="desc">
                <ui:grid items="cehistory:list" class="table table-sm table-hover" thead-class="bg-dark text-light">
                    <ui:columnDateTime header="Created" value="cehistory:created_date" format="d.m.Y H:i:s" th-style="width: 170px" />
                    <ui:column header="Title" value="cehistory:title" />
                    <ui:columnTemplate th-style="width: 30px">
                        <controls:pageLink folderUrl="ce:folder_id.url" type="historyRevision" title="Preview">
                            <fa5:icon name="eye" />
                        </controls:pageLink>
                    </ui:columnTemplate>
                </ui:grid>
            </cehistory:list>
        </div>
    </ui:first>
</ce:list>