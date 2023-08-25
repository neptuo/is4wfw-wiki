<template:attribute name="type" default="view" />

<var:declare name="pageLinkClass" value="template:class" />
<var:declare name="pageLinkTitle" value="template:title" />
<controls:pageUrl url="template:url" folderUrl="template:folderUrl" type="template:type">
    <web:a pageId="template:pageUrl" class="var:pageLinkClass" title="var:pageLinkTitle">
        <template:content />
    </web:a>
</controls:pageUrl>