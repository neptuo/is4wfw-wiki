<template:attribute name="separator" default="true" />

<div class="sticky-top pt-3 pb-3" style="background: white; top: 56px; margin-top: -1.5rem !important;">
    <template:content />
    
    <if:equals name="separator" value="template:separator" is="true" />
    <web:out if:passed="separator">
        <hr class="mb-0">
    </web:out>
</div>