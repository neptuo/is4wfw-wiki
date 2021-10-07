<ce:list name="page" orderBy-title="asc">
    <ui:any items="ce:list">
        <div class="list-group mb-4">
            <ce:register name="url" />
            <ui:forEach items="ce:list">
                <web:a pageId="route:page" text="ce:title" class="list-group-item list-group-item-action" />
            </ui:forEach>
        </div>
    </ui:any>
</ce:list>
<div class="list-group">
    <web:a pageId="route:new" text="New" class="list-group-item list-group-item-action list-group-item-info" />
</div>