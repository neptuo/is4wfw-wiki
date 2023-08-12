<template:attribute name="includeContent" type="bool" />
<template:attribute name="includeDirectoryId" type="bool" />

<filter:declare name="detail" alias="p">
    <filter:equals name="url" value="template:url" />
    <login:authorized none="wiki">
        <filter:equals name="is_public" value="1" />
    </login:authorized>
</filter:declare>
<cef:declare name="pageDetail">
    <cef:add name="id" />
    <cef:add name="title" />
    <cef:add name="folder_id.url" />
    <cef:add name="folder_id.name" />
    <cef:add name="is_public" />
    <cef:add name="changed_date" />
    <cef:add name="content" if:true="template:includeContent" />
    <cef:add name="directory_id" if:true="template:includeDirectoryId" />
</cef:declare>
<cepage:list filter="filter:detail" fields="cef:pageDetail">
    <ui:empty items="cepage:list">
        Not found
    </ui:empty>
    <ui:first items="cepage:list">
        <template:title value="cepage:title" />
        <controls:pageHeader />
        <template:content />
    </ui:first>
</cepage:list>