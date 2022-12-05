<js:style path="https://unpkg.com/easymde/dist/easymde.min.css" />
<js:script path="https://unpkg.com/easymde/dist/easymde.min.js" placement="tail" />
<js:script placement="tail">
    const easyMDE = new EasyMDE({
        element: document.getElementById('md-content'),
        autoDownloadFontAwesome: false
    });
</js:script>

<var:declare name="pageId" value="" />
<var:declare name="folderUrl" value="" />
<web:condition when="template:url">
    <cepage:list filter-url="template:url">
        <cepage:register name="id" />
        <ui:first items="cepage:list">
            <var:declare name="pageId" value="cepage:id" />
            <var:declare name="folderUrl" value="cepage:folder_id.url" />
        </ui:first>
    </cepage:list>
</web:condition>

<template:declare identifier="saveHistory">
    <edit:execute>
        <edit:set name="id" value="template:edit_id" />
        <edit:set name="created_date" value="template:edit_created_date" />
        <edit:set name="title" value="template:edit_title" />
        <edit:set name="url" value="template:edit_url" />
        <edit:set name="content" value="template:edit_content" />
        <edit:set name="is_public" value="template:edit_is_public" />
        <edit:set name="is_archived" value="template:edit_is_archived" />
        <cehistory:save name="pagehistory" />
    </edit:execute>
</template:declare>

<controls:pageUrl folderUrl="var:folderUrl">
    <var:declare name="closeUrl" value="template:pageUrl" />
</controls:pageUrl>

<edit:form submit="save">
    <controls:stickyHeader>
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 text-truncate">
                <h1 class="text-truncate">
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
                <bs:button name="save" value="save" tabindex="5">
                    Save
                </bs:button>
            </div>
            <div class="ml-2">
                <bs:button name="save" value="save-close" tabindex="6" class="text-nowrap">
                    Save and close
                </bs:button>
            </div>
            <div class="ml-2">
                <controls:pageUrl folderUrl="var:folderUrl">
                    <web:a pageId="var:closeUrl" text="Close" class="btn btn-secondary" tabindex="7" />
                </controls:pageUrl>
            </div>
        </div>
    </controls:stickyHeader>
    <cepage:form key-id="var:pageId">
        <web:out if:true="edit:saved">
            <web:condition when="post:save" is="save">
                <var:declare name="redirectType" value="edit" />
            </web:condition>
            <web:condition when="post:save" is="save-close">
                <var:declare name="redirectType" value="view" />
            </web:condition>

            <controls:pageUrl folderUrl="var:folderUrl" type="var:redirectType">
                <var:declare name="redirectUrl" value="template:pageUrl" />    
            </controls:pageUrl>

            <!-- Save history rewrites edit model -->
            <template:saveHistory edit_id="edit:id" edit_created_date="cepage:changed_date" edit_title="cepage:title" edit_url="cepage:url" edit_content="cepage:content" edit_is_public="cepage:is_public" edit_is_archived="cepage:is_archived" />

            <web:redirectTo pageId="var:redirectUrl" />
        </web:out>

        <ui:defaultValue name="created_date" format="web:currentTime" />
        <ui:constant name="changed_date" value="web:currentTime" />

        <bs:row class="form-row">
            <bs:column default="12" medium="2">
                <bs:formGroup label="Folder:" field="folder_id">
                    <ui:dropdownlist name="folder_id" source="ce_folder" display="name" value="id" emptyText="---" class="bs:fieldValidatorCssClass" tabindex="1" />
                </bs:formGroup>
            </bs:column>
            <bs:column default="12" medium="5">
                <bs:formGroup label="Title:" field="title">
                    <ui:textbox name="title" class="bs:fieldValidatorCssClass" tabindex="2" autofocus="autofocus" />
                </bs:formGroup>
            </bs:column>
            <bs:column default="12" medium="5">
                <bs:formGroup label="Url:" field="url">
                    <ui:toUrlValue name="url">
                        <ui:defaultValue name="url" format="{title}">
                            <ui:textbox name="url" class="bs:fieldValidatorCssClass" tabindex="3" />
                        </ui:defaultValue>
                    </ui:toUrlValue>
                </bs:formGroup>
            </bs:column>
            <bs:column default="12">
                <div class="form-check-inline">
                    <ui:checkbox name="is_public" class="form-check-input" id="cbx-public" />
                    <label class="form-check-label" for="cbx-public">
                        Publicly accessible
                    </label>
                </div>
                <div class="form-check-inline">
                    <ui:checkbox name="is_archived" class="form-check-input" id="cbx-archived" />
                    <label class="form-check-label" for="cbx-archived">
                        Archived
                    </label>
                </div>
                <web:out if:stringEmpty="var:pageId" if:not="true">
                    <div class="form-check-inline">
                        <edit:prefix name="user">
                            <ui:checkbox name="is_favorite" class="form-check-input" id="cbx-favorite" />
                            <label class="form-check-label" for="cbx-favorite">
                                Your favorite
                            </label>
                        </edit:prefix>
                    </div>
                </web:out>
            </bs:column>
        </bs:row>
        <bs:formGroup field="content" class="mt-3">
            <ui:textarea id="md-content" name="content" class="bs:fieldValidatorCssClass" style="height:500px;" tabindex="4" />
        </bs:formGroup>

        <web:condition when="edit:submit">
            <val:required key="title" /> 
            <val:required key="url" />

            <controls:pageUniqueValidator pageId="var:pageId" />
            <controls:folderUniqueValidator />
        </web:condition>
    </cepage:form>
    
    <web:out if:stringEmpty="var:pageId" if:not="true">
        <web:out if:true="edit:load">
            <utils:splitToArray output="var:favoritesArray" value="var:favorites" separator="," />
            <if:arrayContains name="isFavorite" value="var:favoritesArray" item="var:pageId" />
            <edit:prefix name="user" if:passed="isFavorite">
                <edit:set name="is_favorite" value="1" />
            </edit:prefix>
        </web:out>
        <web:out if:true="edit:save">
            <edit:prefix name="user">
                <if:eval name="addToFavorites">
                    <if:greater value="edit:is_favorite" than="0" />
                    <if:not>
                        <if:arrayContains value="var:favoritesArray" item="var:pageId" />
                    </if:not>
                </if:eval>
                <web:out if:passed="addToFavorites">
                    <domain:addToFavorites pageId="var:pageId" />
                </web:out>

                <if:eval name="removeFromFavorites">
                    <if:lower value="edit:is_favorite" than="1" />
                    <if:arrayContains value="var:favoritesArray" item="var:pageId" />
                </if:eval>
                <web:out if:passed="removeFromFavorites">
                    <domain:removeFromFavorites pageId="var:pageId" />
                </web:out>
            </edit:prefix>
        </web:out>
    </web:out>
</edit:form>