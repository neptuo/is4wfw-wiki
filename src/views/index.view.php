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

<ce:urlResolver propertyName="url" name="page" columnName="url" />

<router:fromPath path="var:relativeUrl">
    <router:file path="" name="home">
        <div class="list-group">
            <ce:list name="page" orderBy-title="asc">
                <ce:register name="url" />
                <ui:forEach items="ce:list">
                    <web:a pageId="route:page" text="ce:title" class="list-group-item list-group-item-action" />
                </ui:forEach>
            </ce:list>
        </ul>
    </router:file>
    <router:file path="login" name="login">
        <pages:login />
    </router:file>
    <router:file path="settings" name="settings">
    </router:file>
    <router:directory path="\ce:url">
        <var:declare name="pageUrl" value="ce:url" />
        <router:file name="edit" path="edit">
            <pages:edit />
        </router:file>
        <router:file path="" name="page">
            <ce:list name="page" filter-url="ce:url">
                <ui:empty items="ce:list">
                    Not found
                </ui:empty>
                <ui:first items="ce:list">
                    <h1>
                        <web:out text="ce:title" />
                    </h1>
                    <web:out text="ce:content" />
                </ui:first>
            </ce:list>
        </router:file>
    </router:directory>
    <router:file path="*">
        Not found
    </router:file>
</router:fromPath>

<template:declare identifier="redirectToLogin">
    <var:declare name="lastPage" value="web:currentPath" scope="session" />
    <web:redirectTo pageId="route:login" />
</template:declare>
<login:init group="wiki" cookieName="wiki" />
<login:refresh group="wiki" />
<web:condition when="post:logout" is="logout">
    <login:logout group="wiki">
        <template:redirectToLogin />
    </login:logout>
</web:condition>

<nav class="navbar navbar-inverse navbar navbar-expand-lg navbar-dark bg-dark sticky-top main-navbar">
    <bs:container>
        <web:a pageId="route:home" class="navbar-brand">
            Wiki
        </web:a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <login:authorized any="wiki">
                <ul class="navbar-nav large-navbar-nav ml-auto">
                    <li class="nav-item">
                        <web:a pageId="route:settings" class="nav-link">
                            <fa5:icon name="cog" />
                            <span class="d-none d-md-inline">
                                Settings
                            </span>
                        </web:a>
                    </li>
                </ul>
                <ui:form class="form-inline">
                    <bs:button name="logout" value="logout" color="danger" isOutline="true" size="small">
                        <fa5:icon name="sign-out-alt" />
                        <span class="d-none d-md-inline">
                            Log out
                        </span>
                    </bs:button>
                </ui:form>
            </login:authorized>
            <login:authorized none="wiki">
                <ul class="navbar-nav large-navbar-nav ml-auto">
                    <li class="nav-item">
                        <web:a pageId="route:login" class="nav-link">
                            Login
                        </web:a>
                    </li>
                </ul>
            </login:authorized>
        </div>
    </bs:container>
</nav>
<bs:container class="mt-4">
    <router:render />
</bs:container>