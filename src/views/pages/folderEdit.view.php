<var:declare name="folderId" value="" />

<web:condition when="template:url">
    <cefolder:list filter-url="template:url">
        <cefolder:register name="id" />
        <ui:first items="cefolder:list">
            <var:declare name="folderId" value="cefolder:id" />
        </ui:first>
    </cefolder:list>
</web:condition>

<edit:form submit="save">
    <controls:stickyHeader>
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 text-truncate">
                <h1 class="text-truncate">
                    <web:condition when="var:folderId">
                        <template:title value="Edit folder" />
                        Edit folder
                    </web:condition>
                    <web:condition when="var:folderId" isInverted="true">
                        <template:title value="New folder" />
                        New folder
                    </web:condition>
                </h1>
            </div>
            <div>
                <bs:button name="save" value="save" tabindex="4">
                    Save
                </bs:button>
            </div>
            <div class="ml-2">
                <bs:button name="save" value="save-close" tabindex="5" class="text-nowrap">
                    Save and close
                </bs:button>
            </div>
            <div class="ml-2">
                <php:set property="cefolder:linkUrl" value="template:url" />
                <web:a pageId="route:folder" text="Close" class="btn btn-secondary" tabindex="6" />
            </div>
        </div>
    </controls:stickyHeader>
    <cefolder:form key-id="var:folderId">
        <web:condition when="edit:saved">
            <php:set property="cefolder:linkUrl" value="cefolder:url" />
            <web:condition when="post:save" is="save">
                <web:redirectTo pageId="route:folderEdit" />
            </web:condition>
            <web:condition when="post:save" is="save-close">
                <web:redirectTo pageId="route:folder" />
            </web:condition>
        </web:condition>

        <ui:defaultValue name="created_date" format="web:currentTime" />

        <bs:row class="form-row">
            <bs:column default="12" medium="6">
                <bs:formGroup label="Name:" field="name">
                    <ui:textbox name="name" class="bs:fieldValidatorCssClass" tabindex="1" autofocus="autofocus" />
                </bs:formGroup>
            </bs:column>
            <bs:column default="12" medium="6">
                <bs:formGroup label="Url:" field="url">
                    <ui:toUrlValue name="url">
                        <ui:defaultValue name="url" format="{name}">
                            <ui:textbox name="url" class="bs:fieldValidatorCssClass" tabindex="2" />
                        </ui:defaultValue>
                    </ui:toUrlValue>
                </bs:formGroup>
            </bs:column>
        </bs:row>
        
        <web:condition when="edit:submit">
            <val:required key="name" /> 
            <val:required key="url" />

            <controls:pageUniqueValidator />
            <controls:folderUniqueValidator folderId="var:folderId" />
        </web:condition>
    </cefolder:form>
</edit:form>