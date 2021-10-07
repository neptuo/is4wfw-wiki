<h1>Edit page</h1>

<edit:form submit="save">
    <ce:form name="page" key-url="var:pageUrl">
        <web:condition when="edit:saved">
            <web:redirectTo pageId="route:edit" />
        </web:condition>

        <bs:formGroup label="Title" field="title">
            <ui:textbox name="title" class="bs:fieldValidatorCssClass" />
        </bs:formGroup>
        <bs:formGroup label="Url" field="url">
            <ui:textbox name="url" class="bs:fieldValidatorCssClass" />
        </bs:formGroup>
        <bs:formGroup label="Content" field="content">
            <ui:textarea name="content" class="bs:fieldValidatorCssClass" style="height:500px;" />
        </bs:formGroup>
        <div>
            <bs:button name="save">
                Save
            </bs:button>
            <web:a pageId="route:page" text="Close" class="btn btn-secondary" />
        </div>
    </ce:form>
</edit:form>