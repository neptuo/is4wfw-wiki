<js:style path="https://unpkg.com/easymde/dist/easymde.min.css" />
<js:script path="https://unpkg.com/easymde/dist/easymde.min.js" placement="tail" />
<js:script placement="tail">
    const easyMDE = new EasyMDE({
        element: document.getElementById('md-content'),
        autoDownloadFontAwesome: false
    });
</js:script>

<var:declare name="pageId" value="" />
<web:condition when="template:url">
    <ce:list name="page" filter-url="template:url">
        <ce:register name="id" />
        <ui:first items="ce:list">
            <var:declare name="pageId" value="ce:id" />
        </ui:first>
    </ce:list>
</web:condition>

<edit:form submit="save">
    <div class="d-flex align-items-center">
        <div class="flex-grow-1">
            <h1>
                <web:condition when="var:pageId">
                    <template:title value="Edit" />
                    Edit
                </web:condition>
                <web:condition when="var:pageId" isInverted="true">
                    <template:title value="New" />
                    New
                </web:condition>
            </h1>
        </div>
        <div>
            <bs:button name="save" value="save" tabindex="4">
                Save
            </bs:button>
        </div>
        <div class="ml-2">
            <bs:button name="save" value="save-close" tabindex="5">
                Save and close
            </bs:button>
        </div>
        <div class="ml-2">
            <web:a pageId="route:page" text="Close" class="btn btn-secondary" tabindex="6" />
        </div>
    </div>
    <hr>
    <ce:form name="page" key-id="var:pageId">
        <web:condition when="edit:saved">
            <web:condition when="post:save" is="save">
                <web:redirectTo pageId="route:edit" />
            </web:condition>
            <web:condition when="post:save" is="save-close">
                <web:redirectTo pageId="route:page" />
            </web:condition>
        </web:condition>

        <ui:defaultValue name="created_date" format="web:currentTime" />
        <ui:constant name="changed_date" value="web:currentTime" />

        <bs:row>
            <bs:column default="12" medium="6">
                <bs:formGroup label="Title:" field="title">
                    <ui:textbox name="title" class="bs:fieldValidatorCssClass" tabindex="1" autofocus="autofocus" />
                </bs:formGroup>
            </bs:column>
            <bs:column default="12" medium="6">
                <bs:formGroup label="Url:" field="url">
                    <ui:textbox name="url" class="bs:fieldValidatorCssClass" tabindex="2" />
                </bs:formGroup>
                <div class="form-check">
                    <ui:checkbox name="is_public" class="form-check-input" id="cbx-public" />
                    <label class="form-check-label" for="cbx-public">
                        Publicly accessible
                    </label>
                </div>
            </bs:column>
        </bs:row>
        <bs:formGroup label="Content:" field="content">
            <ui:textarea id="md-content" name="content" class="bs:fieldValidatorCssClass" style="height:500px;" tabindex="3" />
        </bs:formGroup>

        <web:condition when="edit:submit">
            <val:required key="title" /> 
            <val:required key="url" />

            <filter:declare name="pageUnique">
                <filter:equals name="url" value="edit:url" />
                <filter:equals name="id" value="var:pageId" not="true" />
            </filter:declare>
            <ce:list name="page" filter="filter:pageUnique">
                <ce:register name="id" />
                <ui:any items="ce:list">
                    <val:add key="url" identifier="unique" />
                </ui:any>
            </ce:list>
        </web:condition>
    </ce:form>
</edit:form>