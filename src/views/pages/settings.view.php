<edit:form submit="instanceNameSave">
    <web:condition when="edit:load">
        <edit:set name="name" value="var:wiki.name" />
    </web:condition>
    <web:condition when="edit:save">
        <var:declare name="wiki.name" value="edit:name" scope="application" />
    </web:condition>
    <web:condition when="edit:saved">
        <web:redirectToSelf />
    </web:condition>

    <div class="form-row align-items-end">
        <bs:column>
            <bs:formGroup label="Instance name:" field="name">
                <ui:textbox name="name" class="bs:fieldValidatorCssClass" />
            </bs:formGroup>
        </bs:column>
        <bs:column default="auto">
            <bs:formGroup>
                <bs:button name="instanceNameSave" text="Save" />
            </bs:formGroup>
        </bs:column>
    </div>
</edit:form>