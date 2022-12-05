<template:attribute name="search" default="true" />
<template:attribute name="empty" default="true" />
<template:attribute name="clearPageId" default="route:home" />

<filter:declare name="page" alias="p">
    <filter:or>
        <filter:like name="content" contains="query:q" />
        <filter:like name="title" contains="query:q" />
    </filter:or>
    <login:authorized none="wiki">
        <filter:equals name="is_public" value="1" />
    </login:authorized>
    <template:content />
</filter:declare>

<if:equals name="search" value="template:search" is="true" />
<edit:form submit="search" if:passed="search">
    <ui:filter>
        <div class="form-row">
            <bs:column>
                <bs:formGroup field="q">
                    <div class="input-group mb-3">
                        <ui:textbox name="q" class="bs:fieldValidatorCssClass" placeholder="Search..." />
                        <div class="input-group-append">
                            <bs:button name="search">
                                <fa5:icon name="search" />
                                <span class="d-none d-md-inline">
                                    Search
                                </span>
                            </bs:button>
                            <web:a pageId="template:clearPageId" class="btn btn-secondary">
                                <span class="d-inline d-md-none">
                                    <fa5:icon name="times" />
                                </span>
                                <span class="d-none d-md-inline">
                                    Clear
                                </span>
                            </web:a>
                        </div>
                    </div>
                </bs:formGroup>
            </bs:column>
            <login:authorized any="wiki">
                <bs:column default="auto">
                    <web:a pageId="route:new" class="btn btn-success">
                        <fa5:icon name="plus" />
                        <span class="d-none d-md-inline">
                            New page
                        </span>
                    </web:a>
                </bs:column>
            </login:authorized>
        </div>
    </ui:filter>
</edit:form>

<cepage:list filter="filter:page" orderBy-title="asc">
    <if:equals name="empty" value="template:empty" is="true" />
    <ui:empty items="cepage:list" if:passed="empty">
        <div class="list-group mb-4">
            <div class="list-group-item">
                <fa5:icon name="battery-empty" />
                <span class="ml-2 text-secondary">
                    Nothing to show here...
                </span>
            </div>
        </div>
    </ui:empty>
    <ui:any items="cepage:list">
        <web:out if:stringEmpty="template:header" if:not="true">
            <h2 class="h1 mx-3" style="font-weight: 300; line-height: 1.2;">
                <web:out text="cefolder:name" />
            </h2>
        </web:out>

        <div class="list-group mb-4">
            <cepage:register name="url" />
            <ui:forEach items="cepage:list">
                <controls:pageLink folderUrl="cepage:folder_id.url" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            <web:out text="cepage:title" />
                        </h5>
                    </div>
                    <div>
                        <small class="mr-1">
                            <fa5:icon prefix="far" name="clock" title="Changed at" />
                            <ui:dateTimeValue value="cepage:changed_date" format="d.m.Y H:i:s" />
                        </small>
                        <web:condition when="cepage:is_public">
                            <small class="mr-1">
                                <fa5:icon name="user-secret" />
                                Public
                            </small>
                        </web:condition>
                        <web:condition when="cepage:is_archived">
                            <small class="mr-1">
                                <fa5:icon name="archive" />
                                Archived
                            </small>
                        </web:condition>
                        
                        <utils:splitToArray output="var:favoritesArray" value="var:favorites" separator="," />
                        <if:arrayContains name="isFavorite" value="var:favoritesArray" item="ce:id" />
                        <web:out if:passed="isFavorite">
                            <small class="mr-1">
                                <fa5:icon name="star" />
                                Your favorite
                            </small>
                        </web:out>
                    </div>
                </controls:pageLink>
            </ui:forEach>
        </div>
    </ui:any>
</cepage:list>