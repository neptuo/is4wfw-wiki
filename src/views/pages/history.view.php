<controls:pageDetail url="template:url">
    <div>
        <cehistory:list filter-id="cepage:id" orderBy-created_date="desc">
            <ui:grid items="cehistory:list" class="table table-hover" thead-class="bg-dark text-light">
                <ui:columnDateTime header="Created" value="cehistory:created_date" format="d.m.Y H:i:s" th-style="width: 170px" />
                <ui:column header="Title" value="cehistory:title" />
                <ui:columnTemplate th-style="width: 30px">
                    <controls:pageLink folderUrl="cepage:folder_id.url" type="historyRevision" title="Preview">
                        <fa5:icon name="eye" />
                    </controls:pageLink>
                </ui:columnTemplate>
            </ui:grid>
        </cehistory:list>
    </div>
</controls:pageDetail>
