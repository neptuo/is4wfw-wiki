<template:declare identifier="navbarItem">
    <template:attribute name="iconPrefix" default="fa" />
    <li class="nav-item">
        <web:a pageId="template:url" class="nav-link">
            <fa5:icon prefix="template:iconPrefix" name="template:icon" />
            <web:out text="template:text" />
            <template:content />
        </web:a>
    </li>
</template:declare>

<nav class="navbar navbar-inverse navbar navbar-expand-lg navbar-dark bg-dark sticky-top main-navbar">
    <bs:container>
        <web:a pageId="route:home" class="navbar-brand">
            <var:declare name="brand" value="var:wiki.name" />
            <web:condition when="var:brand" isInverted="true">
                <var:declare name="brand" value="Wiki" />
            </web:condition>
            <web:out text="var:brand" />
        </web:a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav large-navbar-nav">
                <template:navbarItem url="route:all" icon="file-alt" text="All pages" />
                <template:navbarItem url="route:archive" icon="archive" text="Archive" />
                <template:navbarItem url="route:folderList" icon="folder" iconPrefix="fas" text="Folders" />
                <template:navbarItem url="route:settings" icon="cog" text="Settings" />
                <template:navbarItem url="route:about" icon="info-circle" text="About" />
            </ul>
            <login:authorized any="wiki">
                <ul class="navbar-nav large-navbar-nav ml-auto">
                    <template:navbarItem url="route:profile" icon="user">
                        <login:info field="username" />
                    </template:navbarItem>
                </ul>
                <ui:form class="form-inline ml-mlg-2">
                    <bs:button name="logout" value="logout" color="danger" isOutline="true" size="small">
                        <fa5:icon name="sign-out-alt" />
                        Log out
                    </bs:button>
                </ui:form>
            </login:authorized>
            <login:authorized none="wiki">
                <ul class="navbar-nav large-navbar-nav ml-auto">
                    <li class="nav-item">
                        <web:a pageId="route:login" class="nav-link">
                            <fa5:icon name="sign-in-alt" />
                            Log in
                        </web:a>
                    </li>
                </ul>
            </login:authorized>
        </div>
    </bs:container>
</nav>