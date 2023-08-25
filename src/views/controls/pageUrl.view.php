<template:attribute name="type" default="view" />
<web:out if:stringEmpty="template:folderUrl">
    <php:set property="cepage:linkUrl" value="template:url" />
    <web:switch when="template:type">
        <web:case is="view">
            <route:use name="page">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
        <web:case is="edit">
            <route:use name="edit">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
        <web:case is="history">
            <route:use name="history">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
        <web:case is="historyRevision">
            <route:use name="historyRevision">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
        <web:case is="files">
            <route:use name="files">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
        <web:case is="delete">
            <route:use name="delete">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
    </web:switch>
</web:out>
<web:out if:stringEmpty="template:folderUrl" if:not="true">
    <php:set property="cefolder:linkUrl" value="template:folderUrl" />
    <php:set property="cepage:linkUrlWithFolder" value="template:url" />
    <web:switch when="template:type">
        <web:case is="view">
            <route:use name="pageWithFolder">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
        <web:case is="edit">
            <route:use name="editWithFolder">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
        <web:case is="history">
            <route:use name="historyWithFolder">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
        <web:case is="historyRevision">
            <route:use name="historyRevisionWithFolder">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
        <web:case is="files">
            <route:use name="filesWithFolder">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
        <web:case is="delete">
            <route:use name="deleteWithFolder">
                <template:content pageUrl="route:url" isActive="route:isActive" />
            </route:use>
        </web:case>
    </web:switch>
</web:out>