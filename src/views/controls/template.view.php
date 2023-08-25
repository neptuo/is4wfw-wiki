<controls:auth />

<web:condition when="var:ajax">
    <web:flush template="none" contentType="text/json" />
    <router:render />
</web:condition>
<web:condition when="var:ajax" isInverted="true">
    <web:doctype type="html5" />
    <web:head>
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no,shrink-to-fit=no" />
        
        <style>
            .main-navbar .navbar-toggler {
                border: none;
                outline: none;
            }

            a.dropdown-item .fa, a.dropdown-item .fas {
                width: 20px;
            }
            
            footer.navbar {
                position: absolute;
                bottom: 0;
                width: 100%;
            }

            .navbar-bottom {
                background: #f5f5f5;
                border-top: 1px solid #ddd;
            }

            .navbar-bottom .h4 {
                line-height: 1;
            }
        </style>
    
        <web:out if:stringEmpty="var:wiki.icon.id" if:not="true">
            <img:favicon fileId="var:wiki.icon.id" />
        </web:out>

        <bs:resources />
        <fa5:resources />
    </web:head>
    
    <controls:navbar />

    <bs:container class="mt-4" style="margin-bottom: 72px">
        <var:use name="message" scope="temp" />
        <web:condition when="var:message">
            <bs:alert color="primary" class="mb-4">
                <web:out text="var:message" />
            </bs:alert>
        </web:condition>

        <!-- if:false can't be used here -->
        <web:condition when="router:hasMatch" isInverted="true">
            Not Found 
        </web:condition>
        <router:render />
    </bs:container>

    <template:declare identifier="bottomNavItem">
        <template:attribute name="iconPrefix" default="fa" />

        <bs:column>
            <route:use name="template:route">
                <var:declare name="cssClass" value="btn btn-block" />
                <web:condition when="route:isActive">
                    <var:declare name="cssClass" value="btn btn-block btn-primary" />
                </web:condition>
                <web:condition when="route:isActive" isInverted="true">
                    <var:declare name="cssClass" value="btn btn-block btn-light text-dark" />
                </web:condition>
                <web:a pageId="route:url" class="var:cssClass">
                    <fa5:icon prefix="template:iconPrefix" name="template:icon" />
                </web:a>
            </route:use>
        </bs:column>
    </template:declare>

    <nav class="fixed-bottom d-md-none navbar-bottom py-2">
        <bs:container>
            <bs:row>
                <template:bottomNavItem route="home" icon="home" />
                <template:bottomNavItem route="all" icon="file-alt" />
                <template:bottomNavItem route="archive" icon="archive" />
                <template:bottomNavItem route="favorites" icon="star" />
                <template:bottomNavItem route="folderList" icon="folder" iconPrefix="fas" />
            </bs:row>
        </bs:container>
    </nav>

</web:condition>