<bs:container>
    <h1>Edit page</h1>

    <edit:form submit="save">
        <ce:form name="page" key-url="query:url">
            <web:condition when="edit:saved">
                <web:url pageId="route:edit" param-url="ce:url" isAbsolute="true">
                    <web:redirectTo pageId="web:url" />
                </web:url>
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
                <web:a pageId="route:edit" param-url="ce:url" text="Close" class="btn btn-secondary" />
            </div>
        </ce:form>
    </edit:form>
</bs:container>