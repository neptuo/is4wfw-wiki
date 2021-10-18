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
            <login:authorized any="wiki">
                <ul class="navbar-nav large-navbar-nav ml-auto">
                    <li class="nav-item">
                        <web:a pageId="route:settings" class="nav-link">
                            <fa5:icon name="cog" />
                            Settings
                        </web:a>
                    </li>
                    <li class="nav-item">
                        <web:a pageId="route:profile" class="nav-link">
                            <fa5:icon name="user" />
                            <login:info field="username" />
                        </web:a>
                    </li>
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