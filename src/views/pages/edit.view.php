<js:style path="https://unpkg.com/easymde/dist/easymde.min.css" />
<js:script path="https://unpkg.com/easymde/dist/easymde.min.js" placement="tail" />
<js:script placement="tail">
const easyMDE = new EasyMDE({element: document.getElementById('md-content')});
</js:script>

<h1>
    <web:condition when="template:url">
        Edit
    </web:condition>
    <web:condition when="template:url" isInverted="true">
        New
    </web:condition>
</h1>

<edit:form submit="save">
    <ce:form name="page" key-url="template:url">
        <web:condition when="edit:saved">
            <web:redirectTo pageId="route:edit" />
        </web:condition>

        <ui:defaultValue name="created_date" format="web:currentTime" />
        <ui:constant name="changed_date" value="web:currentTime" />

        <bs:formGroup label="Title" field="title">
            <ui:textbox name="title" class="bs:fieldValidatorCssClass" />
        </bs:formGroup>
        <bs:formGroup label="Url" field="url">
            <ui:textbox name="url" class="bs:fieldValidatorCssClass" />
        </bs:formGroup>
        <bs:formGroup label="Content" field="content">
            <ui:textarea id="md-content" name="content" class="bs:fieldValidatorCssClass" style="height:500px;" />
        </bs:formGroup>
        <div>
            <bs:button name="save">
                Save
            </bs:button>
            <web:a pageId="route:page" text="Close" class="btn btn-secondary" />
        </div>
    </ce:form>
</edit:form>