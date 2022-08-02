<template:attribute name="clearPageId" default="route:home" />

<controls:pageList empty="false" clearPageId="template:clearPageId">
    <filter:null name="folder_id" />
    <template:content />
</controls:pageList>
<cefolder:list name="folder" orderBy-name="asc">
    <ui:forEach items="cefolder:list">
        <controls:pageList header="cefolder:name" search="false" empty="false">
            <filter:equals name="folder_id" value="cefolder:id" />
            <template:content />
        </controls:pageList>
    </ui:forEach>
</cefolder:list>