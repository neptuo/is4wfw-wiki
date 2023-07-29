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
    <cepage:register name="folder_id.url" />
    <cepage:register name="folder_id.name" />
    <cepage:register name="is_public" />
    <cepage:register name="changed_date" />
    <ui:empty items="cepage:list">
        Not found
    </ui:empty>
    <ui:first items="cepage:list">
        <template:title value="cepage:title" />
        <controls:pageHeader />
        <login:authorized any="wiki">
            <ui:form class="form-inline">
                <bs:button color="danger" name="delete" value="delete" class="text-nowrap">
                    <fa5:icon name="trash-alt" />
                    <span>
                        Delete page '<web:out text="cepage:title" />'
                        <web:condition when="cepage:folder_id">
                            from folder '<web:out text="cepage:folder_id.name" />'
                        </web:condition>
                    </span>
                </bs:button>
            </ui:form>
        </login:authorized>
    </ui:first>
</cepage:list>