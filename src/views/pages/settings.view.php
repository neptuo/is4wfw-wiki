<edit:form submit="save">
    <web:condition when="edit:load">
        <edit:set name="name" value="var:wiki.name" />
        <edit:set name="icon" value="var:wiki.icon.id" />
    </web:condition>
    <web:condition when="edit:save">
        <var:declare name="wiki.name" value="edit:name" scope="application" />
        <var:declare name="wiki.icon.id" value="edit:icon" scope="application" />
    </web:condition>
    <web:condition when="edit:saved">
        <web:redirectToSelf />
    </web:condition>

    <bs:formGroup label="Instance name:" field="name">
        <ui:textbox name="name" class="bs:fieldValidatorCssClass" />
    </bs:formGroup>
    <bs:formGroup label="Instance icon file id:" field="icon">
        <ui:textbox name="icon" class="bs:fieldValidatorCssClass" />
    </bs:formGroup>
    <bs:formGroup>
        <bs:button name="save" text="Save" />
    </bs:formGroup>
</edit:form>