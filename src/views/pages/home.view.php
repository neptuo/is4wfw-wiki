<ce:list name="page" orderBy-title="asc">
    <ui:any items="ce:list">
        <div class="list-group mb-4">
            <ce:register name="url" />
            <ui:forEach items="ce:list">
                <web:a pageId="route:page" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            <web:out text="ce:title" />
                        </h5>
                    </div>
                    <small>
                        Changed at <ui:dateTimeValue value="ce:changed_date" format="d.m.Y H:i:s" />
                    </small>
                </web:a>
            </ui:forEach>
        </div>
    </ui:any>
</ce:list>
<div class="list-group">
    <web:a pageId="route:new" class="list-group-item list-group-item-action">
        <fa5:icon name="plus" />
        Create a bright new page
    </web:a>
</div>