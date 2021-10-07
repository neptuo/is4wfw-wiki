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