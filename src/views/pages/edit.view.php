<js:style path="https://unpkg.com/easymde/dist/easymde.min.css" />
<js:script path="https://unpkg.com/easymde/dist/easymde.min.js" placement="tail" />
<js:script placement="tail">
    const easyMDE = new EasyMDE({
        element: document.getElementById('md-content'),
        autoDownloadFontAwesome: false
    });
</js:script>

<edit:form submit="save">
    <div class="d-flex align-items-center">
        <div class="flex-grow-1">
            <h1>
                <web:condition when="template:url">
                    <template:title value="Edit" />
                    Edit
                </web:condition>
                <web:condition when="template:url" isInverted="true">
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
    <ce:form name="page" key-url="template:url">
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
    </ce:form>
</edit:form>