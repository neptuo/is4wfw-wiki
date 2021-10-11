<login:init group="wiki" cookieName="wiki" />
<web:doctype type="html5" />
<web:head>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no,shrink-to-fit=no" />
    <style>
        .main-navbar .navbar-toggler {
            border: none;
            outline: none;
        }
    </style>
</web:head>
<bs:resources />
<fa5:resources />

<template:declare identifier="title">
    <web:setProperty prefix="web" name="pageTitle" value="template:value" />
</template:declare>

<ce:urlResolver propertyName="url" name="page" columnName="url" />

<router:fromPath path="var:relativeUrl">
    <router:file path="" name="home">
        <template:title value="Home" />
        <pages:home />
    </router:file>
    <router:file path="login" name="login">
        <template:title value="Login" />
        <pages:login />
    </router:file>
    <router:file path="settings" name="settings">
        <template:title value="Settings" />
        <pages:settings />
    </router:file>
    <router:file path="profile" name="profile">
        <template:title value="Profile" />
        <pages:profile />
    </router:file>
    <router:file name="new" path="new">
        <login:authorized any="wiki">
            <pages:edit />
        </login:authorized>
    </router:file>
    <router:directory path="\ce:url">
        <var:declare name="pageUrl" value="ce:url" />
        <router:file name="edit" path="edit">
            <login:authorized any="wiki">
                <pages:edit url="var:pageUrl" />
            </login:authorized>
        </router:file>
        <router:file path="" name="page">
            <pages:detail url="var:pageUrl" />
        </router:file>
    </router:directory>
    <router:file path="*">
        Not found
    </router:file>
</router:fromPath>

<controls:auth />

<controls:navbar />
<bs:container class="mt-4">
    <var:use name="message" scope="temp" />
    <web:condition when="var:message">
        <bs:alert color="primary" class="mb-4">
            <web:out text="var:message" />
        </bs:alert>
    </web:condition>

    <router:render />
</bs:container>