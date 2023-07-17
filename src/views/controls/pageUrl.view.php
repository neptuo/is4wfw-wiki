<template:attribute name="type" default="view" />

<web:out if:stringEmpty="template:folderUrl">
    <web:switch when="template:type">
        <web:case is="view">
            <template:content pageUrl="route:page" />
        </web:case>
        <web:case is="edit">
            <template:content pageUrl="route:edit" />
        </web:case>
        <web:case is="history">
            <template:content pageUrl="route:history" />
        </web:case>
        <web:case is="historyRevision">
            <template:content pageUrl="route:historyRevision" />
        </web:case>
        <web:case is="files">
            <template:content pageUrl="route:files" />
        </web:case>
    </web:switch>
</web:out>
<web:out if:stringEmpty="template:folderUrl" if:not="true">
    <php:set property="cefolder:url" value="template:folderUrl" />
    <web:switch when="template:type">
        <web:case is="view">
            <template:content pageUrl="route:pageWithFolder" />
        </web:case>
        <web:case is="edit">
            <template:content pageUrl="route:editWithFolder" />
        </web:case>
        <web:case is="history">
            <template:content pageUrl="route:historyWithFolder" />
        </web:case>
        <web:case is="historyRevision">
            <template:content pageUrl="route:historyRevisionWithFolder" />
        </web:case>
        <web:case is="files">
            <template:content pageUrl="route:filesWithFolder" />
        </web:case>
    </web:switch>
</web:out>